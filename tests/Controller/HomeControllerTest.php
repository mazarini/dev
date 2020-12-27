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

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class HomeControllerTest extends WebTestCase
{
    /**
     * @var KernelBrowser;
     */
    protected $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    /**
     * @dataProvider getUrls
     */
    public function testUrls(string $url, string $target = '/supplier/page-1.html', int $code = Response::HTTP_MOVED_PERMANENTLY): void
    {
        $this->client->request('GET', $url);

        $response = $this->client->getResponse();

        $real = $response->getStatusCode();
        $this->assertSame(
            $code, $real,
            sprintf('The "%s" public URL redirect with code "%d" (real %d).', $url, $code, $real)
        );
        if ($response instanceof RedirectResponse) {
            $real = $response->getTargetUrl();
            $this->assertSame(
                $target, $real,
                sprintf('The "%s" public URL redirect to "%s" (real %d).', $url, $target, $real)
            );
        }
    }

    /**
     * getUrls.
     *
     * @return \Traversable<array>
     */
    public function getUrls(): \Traversable
    {
        yield [''];
        yield ['/'];
    }
}
