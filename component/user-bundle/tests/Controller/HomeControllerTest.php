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

use Mazarini\UserBundle\Test\LoggedTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class HomeControllerTest extends WebTestCase
{
    use LoggedTrait;

    /**
     * @dataProvider getUrls
     */
    public function testUrls(string $url, string $targetUrl): void
    {
        $statusCode = Response::HTTP_MOVED_PERMANENTLY;
        $method = 'GET';
        $parameters = [];
        $client = $this->getLoggedClient('admin');
        $client->request($method, $url, $parameters);
        $response = $client->getResponse();
        $this->assertRedirect($url, $statusCode, $targetUrl, $response);
    }

    protected function assertRedirect(string $url, int $statusCode, string $targetUrl, Response $response): void
    {
        $this->assertTrue($response instanceof RedirectResponse,
             sprintf('The url "%s" is redirect (actual statuscode %d / "%s")', $url, $response->getStatusCode(), Response::$statusTexts[$response->getStatusCode()])
        );
        if ($response instanceof RedirectResponse) {
            $this->assertSame(
            $statusCode,
            $response->getStatusCode(),
            sprintf('The url "%s" is redirect with status %d / "%s" (actual statuscode %d / "%s")', $url, $statusCode, Response::$statusTexts[$statusCode], $response->getStatusCode(), Response::$statusTexts[$response->getStatusCode()])
        );
            $this->assertSame(
            $targetUrl,
            $response->getTargetUrl(),
            sprintf('The url "%s" is redirect to "%s" (actual target "%s")', $url, $targetUrl, $response->getTargetUrl())
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
        yield ['', '/profile'];
        yield ['/admin/user', 'http://localhost/admin/user/'];
        yield ['/profile', 'http://localhost/profile/'];
        yield ['/', '/profile'];
        yield ['/admin/user/', '/admin/user/page-1.html'];
        yield ['/profile/', '/profile/show.html'];
    }
}
