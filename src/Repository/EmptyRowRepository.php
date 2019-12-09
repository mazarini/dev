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

namespace App\Repository;

use App\Entity\EmptyRow;
use App\Pagination\Pagination;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\CountWalker;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;

/**
 * @method EmptyRow|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmptyRow|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmptyRow[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmptyRowRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmptyRow::class);
    }

    public function getPage(int $currentPage = 1, int $pageSize = 10): Pagination
    {
        $query = $this->createQueryBuilder('a')
            ->addSelect('a')
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->setHint(CountWalker::HINT_DISTINCT, false)
            ->setMaxResults($pageSize)
        ;
        $paginator = new DoctrinePaginator($query, true);
        $totalCount = $paginator->count();
        if (0 === $totalCount) {
            return new Pagination(new \ArrayIterator([]), $currentPage, $totalCount, $pageSize);
        }
        $currentPage = Pagination::CURRENT_PAGE($currentPage, $pageSize, $totalCount);
        $query->setFirstResult(($currentPage - 1) * $pageSize);
        $result = $paginator->getIterator();

        return new Pagination($result, $currentPage, $totalCount, $pageSize);
    }
}
