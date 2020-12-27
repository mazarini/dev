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

namespace App\Repository;

use App\Entity\Delivery;
use App\Entity\Supplier;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Mazarini\PaginationBundle\Repository\EntityRepositoryAbstract;

/**
 * @method Delivery|null find($id, $lockMode = null, $lockVersion = null)
 * @method Delivery|null findOneBy(array $criteria, array $orderBy = null)
 * @method Delivery[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeliveryRepository extends EntityRepositoryAbstract
{
    /**
     * @var string
     */
    protected $orderColumn = 'e.day';

    /**
     * @var string
     */
    protected $orderDirection = 'DESC';

    /**
     * @var Supplier
     */
    protected $supplier;

    /**
     * __construct.
     *
     * @return void
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Delivery::class);
    }

    /**
     * Set the value of supplier.
     *
     * @return self
     */
    public function setSupplier(Supplier $supplier)
    {
        $this->supplier = $supplier;

        return $this;
    }

    protected function getPageQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.supplier = :supplier')
            ->setParameter('supplier', $this->supplier)
        ;
    }

    /**
     * findWeek.
     *
     * @return array<int,delivery>
     */
    public function findWeek(\Datetime $begin, \Datetime $end): array
    {
        $entityManager = $this->getEntityManager();
        $begin->setTime(23, 59, 59);
        $end->setTime(23, 59, 59);

        $query = $entityManager->createQuery(
            'SELECT d
            FROM App\Entity\Delivery d
            WHERE :beginDay <= d.day
            AND d.day <= :endDay
            ORDER BY d.day ASC'
        )->setParameter('beginDay', $begin)
        ->setParameter('endDay', $end);
        // returns an array of Product objects
        return $query->getResult();
    }
}
