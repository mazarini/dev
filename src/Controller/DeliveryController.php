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

use App\Entity\Delivery;
use App\Entity\Supplier;
use App\Form\DeliveryType;
use App\Repository\DeliveryRepository;
use Mazarini\CrudBundle\Controller\CrudControllerAbstract;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

 /**
  * @Route("/delivery")
  * @IsGranted("ROLE_USER")
  */
 class DeliveryController extends CrudControllerAbstract
 {
     /**
      * @var Supplier
      */
     protected $supplier;

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

         return $this->PageAction($DeliveryRepository, $page);
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

     /**
      * getPageParameters.
      *
      * @return array<string,string>
      */
     protected function getPageParameters(): array
     {
         return ['id' => (string) $this->supplier->getId()];
     }
 }
