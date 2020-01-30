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

use App\Entity\Delivery;
use App\Form\DeliveryType;
use App\Repository\DeliveryRepository;
use Mazarini\CrudBundle\Controller\AbstractCrudController;
use Mazarini\ToolsBundle\Entity\EntityInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @Route("/delivery")
 */
class DeliveryController extends AbstractCrudController
{
    public function __construct(RequestStack $requestStack, UrlGeneratorInterface $router)
    {
        parent::__construct($requestStack, $router, 'delivery');
        $this->twigFolder = 'delivery/';
    }

    /**
     * @Route("/", name="delivery_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->indexAction();
    }

    /**
     * @Route("/page-{page<[1-9]\d*>}.html", name="delivery_page", methods={"GET"})
     */
    public function page(DeliveryRepository $DeliveryRepository, int $page = 1): Response
    {
        return $this->PageAction($DeliveryRepository, $page);
    }

    /**
     * @Route("/new.html", name="delivery_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        return $this->editAction($request, new Delivery(), DeliveryType::class);
    }

    /**
     * @Route("/show-{id<[1-9]\d*>}.html", name="delivery_show", methods={"GET"})
     */
    public function show(Delivery $entity): Response
    {
        return $this->showAction($entity);
    }

    /**
     * @Route("/edit-{id<[1-9]\d*>}.html", name="delivery_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Delivery $entity): Response
    {
        return $this->editAction($request, $entity, DeliveryType::class);
    }

    /**
     * delete.
     *
     * @Route("/delete-{id<[1-9]\d*>}.html", name="delivery_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Delivery $entity): Response
    {
        return $this->deleteAction($request, $entity);
    }

    protected function valid(EntityInterface $entity): bool
    {
        return true;
    }
}
