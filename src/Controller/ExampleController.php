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
use App\Tool\Data;
use Mazarini\ToolsBundle\Entity\EntityInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class ExampleController extends AbstractController
{
    /**
     * @Route("/", name="example_index", methods={"GET"})
     */
    public function index(ExampleRepository $exampleRepository): Response
    {
        $data = new Data();
        $data->setEntities($exampleRepository->getAll());

        return $this->render('example/index.html.twig', [
            'data' => $data,
        ]);
    }

    /**
     * @Route("/new", name="example_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        return $this->edit($request, new Example());
    }

    /**
     * @Route("/{id}", name="example_show", methods={"GET"})
     */
    public function show(Example $entity): Response
    {
        $data = new Data();
        $data->setEntity($entity);

        return $this->render('example/show.html.twig', [
            'data' => $data,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="example_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Example $entity): Response
    {
        $form = $this->createEntityForm(ExampleType::class, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            if ($entity->isNew()) {
                $entityManager->persist($entity);
            }
            $entityManager->flush();

            return $this->redirectToRoute('example_index');
        }

        $data = new Data();
        $data->setEntity($entity);
        if ($entity->isNew()) {
            $twig = 'example/new.html.twig';
        } else {
            $twig = 'example/edit.html.twig';
        }

        return $this->render($twig, [
            'data' => $data,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="example_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Example $entity): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entity->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($entity);
            $entityManager->flush();
        }

        return $this->redirectToRoute('example_index');
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
    protected function createEntityForm(string $type, EntityInterface $data = null, array $options = []): FormInterface
    {
        return $this->container->get('form.factory')->createNamed('Entity', $type, $data, $options);
    }
}
