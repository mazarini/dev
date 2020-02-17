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

namespace App\Controller;

use App\Entity\Supplier;
use App\Form\SupplierType;
use App\Repository\SupplierRepository;
use Mazarini\CrudBundle\Controller\AbstractCrudController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/supplier")
 * @IsGranted("ROLE_USER")
 */
class SupplierController extends AbstractCrudController
{
    /**
     * @Route("/", name="supplier_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->indexAction();
    }

    /**
     * @Route("/page-{page<[1-9]\d*>}.html", name="supplier_page", methods={"GET"})
     */
    public function page(SupplierRepository $SupplierRepository, int $page = 1): Response
    {
        return $this->PageAction($SupplierRepository, $page);
    }

    /**
     * @Route("/new.html", name="supplier_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        return $this->editAction($request, new Supplier(), SupplierType::class);
    }

    /**
     * @Route("/show-{id<[1-9]\d*>}.html", name="supplier_show", methods={"GET"})
     */
    public function show(Supplier $entity): Response
    {
        return $this->showAction($entity);
    }

    /**
     * @Route("/edit-{id<[1-9]\d*>}.html", name="supplier_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Supplier $entity): Response
    {
        return $this->editAction($request, $entity, SupplierType::class);
    }

    /**
     * delete.
     *
     * @Route("/delete-{id<[1-9]\d*>}.html", name="supplier_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Supplier $entity): Response
    {
        return $this->deleteAction($request, $entity);
    }

    /**
     * getListAction.
     *
     * @return array<string,string>
     */
    protected function getListAction(): array
    {
        return ['_edit' => 'Edit', '_show' => 'Show', 'delivery_index' => 'Delivery'];
    }
}
