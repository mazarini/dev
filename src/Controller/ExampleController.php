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

use App\Entity\Example;
use App\Form\ExampleType;
use App\Repository\ExampleRepository;
use Mazarini\ToolsBundle\Entity\EntityInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @Route("/")
 */
class ExampleController extends AbstractController
{
    public function __construct(RequestStack $requestStack, UrlGeneratorInterface $router)
    {
        parent::__construct($requestStack, $router, 'example');
        $this->twigFolder = 'example/';
    }

    /**
     * @Route("/", name="example_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->indexAction();
    }

    /**
     * @Route("/page-{page}.html", name="example_page", methods={"GET"})
     */
    public function page(ExampleRepository $ExampleRepository, int $page = 1): Response
    {
        return $this->PageAction($ExampleRepository, $page);
    }

    /**
     * @Route("/new", name="example_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        return $this->editAction($request, new Example(), ExampleType::class);
    }

    /**
     * @Route("/{id}", name="example_show", methods={"GET"})
     */
    public function show(Example $entity): Response
    {
        return $this->showAction($entity);
    }

    /**
     * @Route("/{id}/edit", name="example_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Example $entity): Response
    {
        return $this->editAction($request, $entity, ExampleType::class);
    }

    /**
     * delete.
     *
     * @Route("/{id}", name="example_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Example $entity): Response
    {
        return $this->deleteAction($request, $entity);
    }

    protected function valid(EntityInterface $entity): bool
    {
        return true;
    }
}
