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
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class UrlDeliveryControllerTest extends WebTestCase
{
    /**
     * @var KernelBrowser;
     */
    protected $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->logIn();
    }

    /**
     * @dataProvider getUrls
     */
    public function testUrls(string $url, string $method = 'GET', int $response = 200): void
    {
        $this->client->request($method, $url);

        $this->assertSame(
            $response,
            $this->client->getResponse()->getStatusCode(),
            sprintf('The %s public URL loads correctly.', $url)
        );
    }

    /**
     * getUrls.
     *
     * @return \Traversable<array>
     */
    public function getUrls(): \Traversable
    {
        yield ['/delivery', 'GET', 301];
        yield ['/delivery/', 'GET', 302];
        yield ['/delivery/1', 'GET', 302];
        yield ['/delivery/1/', 'GET', 301];
        yield ['/delivery/1/page-0.html', 'GET', 404];
        yield ['/delivery/1/page-1.html'];
        yield ['/delivery/1/page-2.html', 'GET', 302];
        yield ['/delivery/1/new.html'];
        yield ['/delivery/show-1.html', 'GET', 200];
        yield ['/delivery/edit-1.html', 'GET', 200];
    }

    private function logIn(): void
    {
        $container = $this->client->getContainer();
        if (null === $container) {
            $session = null;
        } else {
            $session = $container->get('session');
        }

        $firewallName = 'main';
        // if you don't define multiple connected firewalls, the context defaults to the firewall name
        // See https://symfony.com/doc/current/reference/configuration/security.html#firewall-context
        $firewallContext = 'main';

        // you may need to use a different token class depending on your application.
        // for example, when using Guard authentication you must instantiate PostAuthenticationGuardToken
        $token = new UsernamePasswordToken('admin', null, $firewallName, ['ROLE_ADMIN']);
        if (null !== $session) {
            if (is_a($session, Session::class)) {
                $session->set('_security_'.$firewallContext, serialize($token));
                $session->save();

                $cookie = new Cookie($session->getName(), $session->getId());
                $this->client->getCookieJar()->set($cookie);
            }
        }
    }
}
