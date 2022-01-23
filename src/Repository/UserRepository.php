<?php

/*
 * This file is part of the mazarini/dev project.
 *
 * (c) Mazarini <mazarini@protonmail.com.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Repository;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Mazarini\UserBundle\Repository\UserRepository as BaseMUserRepository;

class UserRepository extends BaseMUserRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
}
