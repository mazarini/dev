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

use App\Tool\Data;
use Mazarini\ToolsBundle\Entity\EntityInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyControler;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

abstract class AbstractController extends SymfonyControler
{
    use ActionTrait;
    /**
     * @var string
     */
    protected $twigFolder = '';

    /**
     * @var Data
     */
    protected $data;

    /**
     * @var array<string,mixed>
     */
    protected $parameters;

    public function __construct(RequestStack $requestStack, UrlGeneratorInterface $router, string $baseRoute)
    {
        $base = '';
        $currentUrl = '';
        $current = '';
        $request = $requestStack->getMasterRequest();
        if (null !== $request) {
            $currentUrl = $request->getPathInfo();
            $current = $request->attributes->get('_route');
            if (mb_substr($current, 0, mb_strlen($baseRoute)) === $baseRoute) {
                $base = $baseRoute;
                $current = mb_substr($current, mb_strlen($baseRoute));
            }
        }

        $this->data = new Data($router, $base, $current, $currentUrl);
        $this->parameters['data'] = $this->data;
    }

    /**
     * createEntityForm.
     *
     * Creates and returns a Form instance from the type of the form.
     *
     * @param array<int,mixed> $options
     *
     * @return FormInterface<string,mixed>
     */
    protected function createEntityForm(string $type, EntityInterface $entity = null, array $options = []): FormInterface
    {
        return $this->container->get('form.factory')->createNamed('Entity', $type, $entity, $options);
    }

    /**
     * DataRender.
     *
     * @param array<string,mixed> $parameters
     */
    protected function dataRender(string $view, array $parameters = [], Response $response = null): Response
    {
        $parameters = array_merge($this->parameters, $parameters);
        $this->initUrl($this->data);

        return $this->render($this->twigFolder.$view, $parameters, $response);
    }

    protected function crudUrl(Data $data): self
    {
        if ($data->isSetEntity()) {
            $id = $data->getEntity()->getId();
            $parameters = ['id' => $id];
            foreach (['_edit', '_show', '_delete'] as $action) {
                $data->addLink($action, $action, $parameters);
            }
        }
        foreach (['_new', '_index'] as $action) {
            $data->addLink($action, $action);
        }

        return $this;
    }

    protected function PaginationUrl(Data $data): self
    {
        if ($data->isSetEntities()) {
            $pagination = $data->getPagination();
            if ($pagination->hasPreviousPage()) {
                $data->addLink('first', '_page', ['page' => 1]);
                $data->addLink('previous', '_page', ['page' => $pagination->getCurrentPage() - 1]);
            }
            if ($pagination->hasNextPage()) {
                $last = $pagination->getLastPage();
                $data->addLink('Next', '_page', ['page' => $pagination->getCurrentPage() + 1]);
                $data->addLink('Last', '_page', ['page' => $last]);
            }
            if (($last = $pagination->getLastPage()) <= 20) {
                for ($i = 1; $i <= $last; ++$i) {
                    $data->addLink('page-'.$i, '_page', ['page' => $i]);
                }
            }
        }

        return $this;
    }

    protected function listUrl(Data $data): self
    {
        if ($data->isSetEntities()) {
            foreach ($data->getEntities() as $entity) {
                $id = $entity->getId();
                $parameters = ['id' => $id];
                foreach (['_edit', '_show'] as $action) {
                    $data->addLink($action.'-'.$id, $action, $parameters);
                }
            }
        }

        return $this;
    }

    protected function initUrl(Data $data): self
    {
        $this->crudUrl($data);
        $this->listUrl($data);
        $this->paginationUrl($data);

        return $this;
    }

    abstract protected function valid(EntityInterface $entity): bool;
}
