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
use App\Entity\Supplier;
use App\Form\DeliveryType;
use App\Repository\DeliveryRepository;
use Mazarini\CrudBundle\Controller\AbstractCrudController;
use Mazarini\ToolsBundle\Controller\AbstractController;
use Mazarini\ToolsBundle\Data\Data;
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
     /**
      * @var Supplier
      */
     protected $supplier;

     public function __construct(RequestStack $requestStack, UrlGeneratorInterface $router)
     {
         parent::__construct($requestStack, $router, 'delivery');
         $this->twigFolder = 'delivery/';
     }

     /**
      * @Route("/", name="delivery_index_bis", methods={"GET"})
      */
     public function indexBis(): Response
     {
         return $this->redirect($this->data->generateUrl('supplier_page', ['page' => 1]));
     }

     /**
      * @Route("/{id<[1-9]\d*>}", name="delivery_index", methods={"GET"})
      */
     public function index(Supplier $supplier): Response
     {
         return $this->redirect($this->data->generateUrl('_page', ['id' => $supplier->getId(), 'page' => 1]));
     }

     /**
      * @Route("/{id}/page-{page<[1-9]\d*>}.html", name="delivery_page", methods={"GET"})
      */
     public function page(DeliveryRepository $DeliveryRepository, Supplier $supplier, int $page = 1): Response
     {
         $this->parameters['supplier'] = $this->supplier = $supplier;
         $DeliveryRepository->setSupplier($supplier);

         $this->data->setPagination($DeliveryRepository->getPage($page));

         if ($page === $this->data->getPagination()->getCurrentPage()) {
             return $this->dataRender('index.html.twig');
         }

         return $this->redirect($this->data->generateUrl('_page', ['id' => $supplier->getId(), 'page' => $this->data->getPagination()->getCurrentPage()]));
     }

     /**
      * @Route("/{id}/new.html", name="delivery_new", methods={"GET","POST"})
      */
     public function new(Request $request, Supplier $supplier): Response
     {
         $this->parameters['supplier'] = $this->supplier = $supplier;
         $delivery = new Delivery();
         $delivery->setSupplier($supplier);

         return $this->editAction($request, $delivery, DeliveryType::class);
     }

     /**
      * @Route("/show-{id<[1-9]\d*>}.html", name="delivery_show", methods={"GET"})
      */
     public function show(Delivery $entity): Response
     {
         $this->parameters['supplier'] = $this->supplier = $entity->getsupplier();

         return $this->showAction($entity);
     }

     /**
      * @Route("/edit-{id<[1-9]\d*>}.html", name="delivery_edit", methods={"GET","POST"})
      */
     public function edit(Request $request, Delivery $entity): Response
     {
         $this->parameters['supplier'] = $this->supplier = $entity->getsupplier();

         return $this->editAction($request, $entity, DeliveryType::class);
     }

     /**
      * delete.
      *
      * @Route("/delete-{id<[1-9]\d*>}.html", name="delivery_delete", methods={"DELETE"})
      */
     public function delete(Request $request, Delivery $entity): Response
     {
         $this->parameters['supplier'] = $this->supplier = $entity->getsupplier();

         return $this->deleteAction($request, $entity);
     }

     protected function valid(EntityInterface $entity): bool
     {
         return true;
     }

     protected function initUrl(Data $data): AbstractController
     {
         $this->listUrl($data, ['show', 'edit']);
         $this->paginationUrl($data);
         $this->crudUrl($data);
         $data->addLink('new', $data->generateUrl('_new', ['id' => $this->supplier->getId(), 'page' => 1]), 'Create');

         return $this;
     }

     protected function PaginationUrl(Data $data): AbstractController
     {
         if ($data->isSetEntities()) {
             $pagination = $data->getPagination();
             $last = $pagination->getLastPage();
             if ($pagination->hasPreviousPage()) {
                 $navUrl['first'] = $data->generateUrl('_page', ['id' => $this->supplier->getId(), 'page' => 1]);
                 $navUrl['previous'] = $data->generateUrl('_page', ['id' => $this->supplier->getId(), 'page' => $pagination->getCurrentPage() - 1]);
             } else {
                 $navUrl['first'] = '#';
                 $navUrl['previous'] = '#';
             }
             if ($pagination->hasNextPage()) {
                 $navUrl['next'] = $data->generateUrl('_page', ['id' => $this->supplier->getId(), 'page' => $pagination->getCurrentPage() + 1]);
                 $navUrl['last'] = $data->generateUrl('_page', ['id' => $this->supplier->getId(), 'page' => $last]);
             } else {
                 $navUrl['next'] = '#';
                 $navUrl['last'] = '#';
             }
             $data->addLink('first', $navUrl['first'], '1');
             $data->addLink('previous', $navUrl['previous']);
             $data->addLink('next', $navUrl['next']);
             $data->addLink('last', $navUrl['last'], (string) $last);
             for ($i = 1; $i <= $last; ++$i) {
                 $data->addLink('page-'.$i, $data->generateUrl('_page', ['id' => $this->supplier->getId(), 'page' => $i]), (string) $i);
             }
         } else {
             $data->addLink('index', $data->generateUrl('_page', ['id' => $this->supplier->getId(), 'page' => 1]), 'List');
         }

         return $this;
     }
 }
