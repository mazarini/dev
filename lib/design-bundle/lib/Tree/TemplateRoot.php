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

/**
 * TemplateNode.
 *
 * @method TemplateNode getRoot()
 * @method TemplateNode current()
 */
class TemplateRoot extends TemplateNode
{
    private string $currentContentId;

    /**
     * __construct.
     */
    public function __construct(string $root, string $path)
    {
        if (is_dir($root.\DIRECTORY_SEPARATOR.$path)) {
            $this->content = new Folder($path);
            $dirs = scandir($root.\DIRECTORY_SEPARATOR.$path);
            if (false !== $dirs) {
                foreach ($dirs as $dir) {
                    if ('.' !== $dir && '..' !== $dir && 'layout.html.twig' !== $dir) {
                        $this->addChild(new self($root, $path.\DIRECTORY_SEPARATOR.$dir));
                    }
                }
            }
        } else {
            $this->content = new Template($path);
        }
    }

    /**
     * Get the value of currentContentId.
     */
    public function getCurrentContentId()
    {
        return $this->currentContentId;
    }

    /**
     * Set the value of currentContentId.
     */
    public function setCurrentContentId(string $currentContentId): self
    {
        $this->currentContentId = $currentContentId;

        return $this;
    }
}
