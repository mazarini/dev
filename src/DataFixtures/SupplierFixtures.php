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

use App\Entity\Supplier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SupplierFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getSupplierData() as [$name]) {
            $supplier = new Supplier();
            $supplier->setName($name);
            $manager->persist($supplier);
        }
        $manager->flush();
    }

    /**
     * getSupplierData.
     *
     * @return array<int,array>
     */
    private function getSupplierData(): array
    {
        return [
            // $supplierData = [$name];
            ['Cheese Doe'],
            ['Tom Butcher'],
        ];
    }
}
