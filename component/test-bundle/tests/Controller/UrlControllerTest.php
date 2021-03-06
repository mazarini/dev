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

namespace App\Tests\Controller;

use Mazarini\TestBundle\Test\Controller\UrlControllerAbstractTest;

class UrlControllerTest extends UrlControllerAbstractTest
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * getUrls.
     *
     * @return \Traversable<mixed,array>
     */
    public function getUrls(): \Traversable
    {
        yield ['/test', 404];
    }
}
