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

use App\Entity\FakeEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Mazarini\ToolsBundle\Entity\EntityInterface;

class FakeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 45; ++$i) {
            $manager->persist($this->getEntity($i));
        }

        $manager->flush();
    }

    protected function getEntity(int $i): EntityInterface
    {
        return (new FakeEntity())
            ->setCol1(sprintf('row%02d / col1', $i))
            ->setCol2(sprintf('row%02d / col2', $i));
    }
}
