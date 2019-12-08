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

namespace App\Tool;

use Mazarini\ToolsBundle\Entity\EntityInterface;

class Data
{
    /**
     * @var string
     */
    private $baseRoute;

    /**
     * @var string
     */
    private $currentRoute;

    /**
     * @var \ArrayIterator<int,EntityInterface>
     */
    private $entities;

    /**
     * @var EntityInterface
     */
    private $entity;

    /**
     * @var Links
     */
    private $links;

    public function __construct(string $baseRoute, string $currentRoute, string $currentUrl)
    {
        $this->baseRoute = $baseRoute;
        $this->currentRoute = $currentRoute;
        $this->links = new Links($currentRoute, $currentUrl);
    }

    public function isSetEntities(): bool
    {
        return isset($this->entities);
    }

    /**
     * Get the value of entities.
     *
     * @return \ArrayIterator<int,EntityInterface>
     */
    public function getEntities(): \ArrayIterator
    {
        return $this->entities;
    }

    /**
     * Set the value of entities.
     *
     * @param \ArrayIterator<int,EntityInterface> $entities
     */
    public function setEntities(\ArrayIterator $entities): self
    {
        $this->entities = $entities;

        return $this;
    }

    /**
     * IsSet the value of entity ?
     */
    public function isSetEntity(): bool
    {
        return isset($this->entity);
    }

    /**
     * Get the value of entity.
     */
    public function getEntity(): EntityInterface
    {
        return $this->entity;
    }

    /**
     * Set the value of entity.
     */
    public function setEntity(EntityInterface $entity): self
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * Get the value of links.
     */
    public function getLinks(): Links
    {
        return $this->links;
    }

    /**
     * Get the value of Route.
     */
    public function getRoute(string $name): string
    {
        return $this->baseRoute.$name;
    }

    /**
     * Get the value of currentRoute.
     */
    public function getCurrentRoute(): string
    {
        return $this->currentRoute;
    }
}
