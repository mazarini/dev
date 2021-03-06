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

use App\Entity\Five;
use App\Form\FiveType;
use App\Repository\FiveRepository;
use Mazarini\CrudBundle\Controller\CrudControllerAbstract;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/five")
 */
class FiveController extends CrudControllerAbstract
{
    /**
     * @Route("/", name="five_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->indexAction();
    }

    /**
     * @Route("/page-{page<[1-9]\d*>}.html", name="five_page", methods={"GET"})
     */
    public function page(FiveRepository $FiveRepository, int $page = 1): Response
    {
        return $this->PageAction($FiveRepository, $page);
    }

    /**
     * @Route("/new.html", name="five_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        return $this->editAction($request, new Five(), FiveType::class);
    }

    /**
     * @Route("/show-{id<[1-9]\d*>}.html", name="five_show", methods={"GET"})
     */
    public function show(Five $entity): Response
    {
        return $this->showAction($entity);
    }

    /**
     * @Route("/edit-{id<[1-9]\d*>}.html", name="five_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Five $entity): Response
    {
        return $this->editAction($request, $entity, FiveType::class);
    }

    /**
     * delete.
     *
     * @Route("/delete-{id<[1-9]\d*>}.html", name="five_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Five $entity): Response
    {
        return $this->deleteAction($request, $entity);
    }
}
