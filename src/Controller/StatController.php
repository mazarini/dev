<?php

/*
 * Copyright (C) 2019 Mazarini <mazarini@protonmail.com>.
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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/stat")
 */
class StatController extends AbstractController
{
    /**
     * @Route("/{y}/{m}/{d}", name="stat_week")
     */
    public function week(DeliveryRepository $deliveryRepository, int $y = 0, int $m = 1, int $d = 1): Response
    {
        $date = new \Datetime();
        if ($y > 0) {
            $date->setDate($y, $m, $d);
        }
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
        foreach ($deliveries as $delivery) {
            $name = $delivery->getSupplier()->getName();
            if (!isset($amounts[$name])) {
                foreach ($dates as $date) {
                    $amounts[$name][$date->format('Ymd')] = 0;
                }
            }
            $amounts[$name][$delivery->getday()->format('Ymd')] += $delivery->getAmount();
        }

        return $this->dataRender('stat/week.html.twig', [
            'dates' => $dates,
            'amounts' => $amounts,
        ]);
    }

    protected function initUrl(Data $data): AbstractController
    {
        return $this;
    }
}
