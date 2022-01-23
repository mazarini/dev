<?php

/*
 * This file is part of the mazarini/dev project.
 *
 * (c) Mazarini <mazarini@protonmail.com.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Mazarini\UserBundle\Entity\User as UserBase;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User extends UserBase
{
    /*
    [ORM\Id]
    [ORM\GeneratedValue]
    [ORM\Column(type: 'integer')]
    protected int $id = 0;
    */
}
