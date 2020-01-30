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

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mazarini\ToolsBundle\Entity\EntityInterface;
use Mazarini\ToolsBundle\Entity\EntityTrait;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeliveryRepository")
 */
class Delivery implements EntityInterface
{
    use EntityTrait;

    /**
     * @ORM\Column(type="date")
     *
     * @var \datetime
     */
    private $day;

    /**
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $amount = 0;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Supplier", inversedBy="deliveries")
     * @ORM\JoinColumn(nullable=false)
     *
     * @var Supplier
     */
    private $supplier;

    public function __construct()
    {
        $this->day = new \DateTime('now');
    }

    public function getDay(): \DateTime
    {
        return $this->day;
    }

    public function setDay(\DateTime $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getSupplier(): Supplier
    {
        return $this->supplier;
    }

    public function setSupplier(Supplier $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }
}
