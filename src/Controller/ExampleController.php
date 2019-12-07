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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        return $this->render('example/index.html.twig', [
            'examples' => $exampleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="example_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $example = new Example();
        $form = $this->createForm(ExampleType::class, $example);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($example);
            $entityManager->flush();

            return $this->redirectToRoute('example_index');
        }

        return $this->render('example/new.html.twig', [
            'example' => $example,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="example_show", methods={"GET"})
     */
    public function show(Example $example): Response
    {
        return $this->render('example/show.html.twig', [
            'example' => $example,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="example_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Example $example): Response
    {
        $form = $this->createForm(ExampleType::class, $example);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('example_index');
        }

        return $this->render('example/edit.html.twig', [
            'example' => $example,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="example_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Example $example): Response
    {
        if ($this->isCsrfTokenValid('delete'.$example->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($example);
            $entityManager->flush();
        }

        return $this->redirectToRoute('example_index');
    }
}
