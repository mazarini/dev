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

class Folder
{
    private string $path = '';
    private string $label = '';

    public function __construct(string $folder)
    {
        $this->path = $folder;
        $this->label = mb_substr(basename($folder, '.html.twig'), 3);
    }

    public function getId(): string
    {
        return $this->path;
    }

    public function getlabel(): string
    {
        return $this->label;
    }
}
