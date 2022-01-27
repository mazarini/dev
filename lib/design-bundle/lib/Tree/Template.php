<?php

/*
 * This file is part of the mazarini/dev project.
 *
 * (c) Mazarini <mazarini@protonmail.com.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mazarini\DesignBundle\Tree;

class Template extends Folder
{
    public function __construct(string $template)
    {
        parent::__construct($template);
    }

    public function getTemplate(): string
    {
        return $this->getId();
    }
}
