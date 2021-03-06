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

use App\Entity\Ten;
use Doctrine\Persistence\ManagerRegistry;
use Mazarini\PaginationBundle\Repository\EntityRepositoryAbstract;

/**
 * @method Ten|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ten|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ten[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TenRepository extends EntityRepositoryAbstract
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ten::class);
    }
}
