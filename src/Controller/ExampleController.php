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
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @Route("/")
 */
class ExampleController extends AbstractController
{
    /**
     * @var Data
     */
    protected $data;

    /**
     * @var array<string,mixed>
     */
    protected $parameters;

    public function __construct(RequestStack $requestStack, UrlGeneratorInterface $router)
    {
        $currentUrl = '';
        $base = '';
        $current = '';
        $request = $requestStack->getMasterRequest();
        if (null !== $request) {
            $currentUrl = $request->getPathInfo();
            $part = explode('_', $request->attributes->get('_route'));
            if (\count($part) > 1) {
                $base = $part[array_key_first($part)];
                $part[array_key_first($part)] = '';
                $current = implode('_', $part);
            } else {
                $current = $request->attributes->get('_route');
            }
        }

        $this->data = new Data($router, $base, $current, $currentUrl);
        $this->parameters['data'] = $this->data;
    }

    /**
     * @Route("/", name="example_index", methods={"GET"})
     */
    public function index(ExampleRepository $exampleRepository): Response
    {
        $this->data->setEntities($exampleRepository->getAll());

        return $this->dataRender('example/index.html.twig');
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
        $this->data->setEntity($entity);

        return $this->dataRender('example/show.html.twig', []);
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

            return $this->redirectToRoute('example_show', ['id' => $entity->getId()]);
        }

        $this->data->setEntity($entity);
        if ($entity->isNew()) {
            $twig = 'example/new.html.twig';
        } else {
            $twig = 'example/edit.html.twig';
        }

        return $this->dataRender($twig, [
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

        return $this->render($view, $parameters, $response);
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

    protected function listUrl(Data $data): self
    {
        if ($data->isSetEntities()) {
            foreach ($data->getEntities() as $entity) {
                $id = $entity->getId();
                $parameters = ['id' => $id];
                foreach (['_edit', '_show', '_delete'] as $action) {
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

        return $this;
    }
}
