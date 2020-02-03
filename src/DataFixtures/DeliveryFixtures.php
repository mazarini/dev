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

namespace App\DataFixtures;

use App\Entity\Delivery;
use App\Entity\Supplier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DeliveryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $suppliers = [];
        foreach ($this->getDeliveryData() as [$name, $dayStr, $amount]) {
            $delivery = new Delivery();
            if (isset($suppliers[$name])) {
                $supplier = $suppliers[$name];
            } else {
                $supplier = new Supplier();
                $manager->persist($supplier);
                $suppliers[$name] = $supplier->setName($name);
            }
            $delivery->setSupplier($supplier);
            $day = \DateTime::createFromFormat('Y-m-j', $dayStr);
            if ($day instanceof \Datetime) {
                $delivery->setDay($day);
            }
            $delivery->setAmount($amount);
            $manager->persist($delivery);
        }
        $first = new Supplier();
        $manager->persist($first);
        $first->setName('First');

        $second = new Supplier();
        $manager->persist($second);
        $second->setName('Second');

        $manager->flush();

        $day = \DateTime::createFromFormat('Y-m-j', '2019-12-31');
        if ($day instanceof \Datetime) {
            for ($i = 1; $i <= 366; ++$i) {
                $delivery = new Delivery();
                $delivery->setSupplier($first);
                $delivery->setDay($day);
                $delivery->setAmount($i);
                $manager->persist($delivery);

                $delivery = new Delivery();
                $delivery->setSupplier($second);
                $delivery->setDay($day);
                $delivery->setAmount($i * 100);
                $manager->persist($delivery);

                $day->add(new \DateInterval('P1D'));
                $manager->flush();
            }
        }
    }

    /**
     * getDeliveryData.
     *
     * @return array<int,array>
     */
    private function getDeliveryData(): array
    {
        return [
            // $deliveryData = [$name, day, amount];
            ['Breadchef', '2020-01-01', 120],
            ['Breadchef', '2020-01-02', 145],
            ['Breadchef', '2020-01-03', 232],
            ['Fisher', '2020-01-01', 350],
            ['Fisher', '2020-01-03', 442],
            ['Fisher', '2020-01-03', 452],
        ];
    }
}
