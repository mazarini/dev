<?php

/*
 * This file is part of the mazarini/dev project.
 *
 * (c) Mazarini <mazarini@protonmail.com.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mazarini\ToolsBundle\Tree;

/**
 * EmptyNode.
 */
class EmptyNode extends Iterator
{
    private EmptyNode $parent;
    private bool $enable = true;

    /**
     * addChild.
     *
     * @param self $child
     */
    public function addChild($child): self
    {
        $child->setparent($this);
        parent::addChild($child);

        return $this;
    }

    public function getRoot(): self
    {
        if (isset($this->parent)) {
            return $this->parent->getRoot();
        }

        return $this;
    }

    /**
     * Set the value of parent.
     */
    public function setParent(self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function isEnable(): bool
    {
        return $this->enable;
    }

    public function enable(): self
    {
        $this->enable = true;

        return $this;
    }

    public function disable(): self
    {
        $this->enable = false;

        return $this;
    }
}
