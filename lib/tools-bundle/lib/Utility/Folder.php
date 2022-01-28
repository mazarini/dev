<?php

/*
 * This file is part of the mazarini/dev project.
 *
 * (c) Mazarini <mazarini@protonmail.com.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mazarini\ToolsBundle\Utility;

class Folder
{
    private string $projectRoot;

    public function __construct(string $projectRoot)
    {
        $this->projectRoot = $projectRoot;
    }

    public function getProjectRoot(): string
    {
        return $this->projectRoot;
    }

    public function getTemplateRoot(string $dir = null): string
    {
        $template = $this->projectRoot.\DIRECTORY_SEPARATOR.'templates';
        if (null !== $dir) {
            $template .= \DIRECTORY_SEPARATOR.trim($dir, '\\/');
        }

        return $template;
    }
}
