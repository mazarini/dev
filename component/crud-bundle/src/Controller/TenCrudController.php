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

use App\Entity\Ten;
use App\Form\TenType;
use App\Repository\TenRepository;
use Mazarini\CrudBundle\Controller\CrudControllerAbstract;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ten")
 */
class TenCrudController extends CrudControllerAbstract
{
    /**
     * @Route("/", name="ten_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->indexAction();
    }

    /**
     * @Route("/page-{page<[1-9]\d*>}.html", name="ten_page", methods={"GET"})
     */
    public function page(TenRepository $tenRepository, int $page = 1): Response
    {
        return $this->PageAction($tenRepository, $page);
    }

    /**
     * @Route("/new.html", name="ten_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        return $this->editAction($request, new Ten(), TenType::class);
    }

    /**
     * @Route("/show-{id<[1-9]\d*>}.html", name="ten_show", methods={"GET"})
     */
    public function show(Ten $entity): Response
    {
        return $this->showAction($entity);
    }

    /**
     * @Route("/edit-{id<[1-9]\d*>}.html", name="ten_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ten $entity): Response
    {
        return $this->editAction($request, $entity, TenType::class);
    }

    /**
     * delete.
     *
     * @Route("/delete-{id<[1-9]\d*>}.html", name="ten_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ten $entity): Response
    {
        return $this->deleteAction($request, $entity);
    }
}
