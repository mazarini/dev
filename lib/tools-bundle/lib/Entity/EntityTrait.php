<?php

/*
 * This file is part of the mazarini/dev project.
 *
 * (c) Mazarini <mazarini@protonmail.com.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mazarini\ToolsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

trait EntityTrait
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected int $id = 0;

    public function getId(): int
    {
        return $this->id;
    }

    public function isNew(): bool
    {
        return 0 === $this->id;
    }
}
