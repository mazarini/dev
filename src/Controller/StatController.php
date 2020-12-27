<?php

/*
 * Copyright (C) 2019-2020 Mazarini <mazarini@protonmail.com>.
 * This file is part of mazarini/dev.
 *
 * mazarini/dev is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or (at your
 * option) any later version.
 *
 * mazarini/dev is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
 * more details.
 *
 * You should have received a copy of the GNU General Public License
 */

namespace App\Controller;

use App\Repository\DeliveryRepository;
use Mazarini\ToolsBundle\Controller\AbstractController;
use Mazarini\ToolsBundle\Data\Data;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/stat")
 * @IsGranted("ROLE_USER")
 */
class StatController extends AbstractController
{
    /**
     * @Route("/", name="stat_week")
     */
    public function week(Request $request, DeliveryRepository $deliveryRepository): Response
    {
        $date = new \Datetime();
        $askDate = $request->request->get('date');
        if (null !== $askDate) {
            $date = \DateTime::createFromFormat('d/m/Y', $askDate);
        }
        if (false === $date) {
            $date = new \Datetime();
        }
        [$dates[1],$amounts[1]] = $this->getWeek($deliveryRepository, $date);
        [$dates[2],$amounts[2]] = $this->getWeek($deliveryRepository, $date->sub(new \DateInterval('P7D')));
        [$dates[3],$amounts[3]] = $this->getWeek($deliveryRepository, $date->sub(new \DateInterval('P21D')));
        [$dates[4],$amounts[4]] = $this->getWeek($deliveryRepository, $date->sub(new \DateInterval('P336D')));

        return $this->dataRender('week.html.twig', [
            'dates' => $dates,
            'amounts' => $amounts,
        ]);
    }

    /**
     * getWeek.
     *
     * @return array<int,array>
     */
    protected function getWeek(DeliveryRepository $deliveryRepository, \Datetime $date): array
    {
        $move = $date->format('N');
        $dates[0] = new \Datetime();
        $dates[0]->setTimestamp($date->getTimestamp());
        if ('0' !== $move) {
            $dates[0]->sub(new \DateInterval('P'.$move.'D'));
        }
        for ($i = 1; $i < 8; ++$i) {
            $dates[$i] = new \Datetime();
            $dates[$i]->setTimestamp($dates[$i - 1]->getTimestamp());
            $dates[$i]->add(new \DateInterval('P1D'));
        }
        $amounts = [];
        $deliveries = $deliveryRepository->findWeek($dates[0], $dates[7]);
        unset($dates[0]);
        foreach ($dates as $date) {
            $amounts['Cumul fournisseurs'][$date->format('Ymd')] = 0;
        }
        $amounts['Cumul fournisseurs']['Total'] = 0;
        foreach ($deliveries as $delivery) {
            $name = $delivery->getSupplier()->getName();
            if (!isset($amounts[$name])) {
                foreach ($dates as $date) {
                    $amounts[$name][$date->format('Ymd')] = 0;
                }
                $amounts[$name]['Total'] = 0;
            }
            $amounts[$name][$delivery->getday()->format('Ymd')] += $delivery->getAmount();
            $amounts['Cumul fournisseurs'][$delivery->getday()->format('Ymd')] += $delivery->getAmount();
            $amounts[$name]['Total'] += $delivery->getAmount();
            $amounts['Cumul fournisseurs']['Total'] += $delivery->getAmount();
        }

        return [$dates, $amounts];
    }

    protected function initUrl(Data $data): AbstractController
    {
        return $this;
    }
}
