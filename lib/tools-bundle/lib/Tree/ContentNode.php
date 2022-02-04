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
 * ContentNode.
 *
 * @method ContentNode getRoot()
 * @method ContentNode current()
 */
class ContentNode extends EmptyNode
{
    /**
     * $content.
     *
     * @var object|string
     */
    protected $content;

    /**
     * __construct.
     *
     * @param object|string $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * getContent.
     *
     * @return object|string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * getContentId.
     *
     * @return string|int|null
     */
    protected function getContentId()
    {
        $content = $this->getContent();
        $return = null;
        switch (true) {
            case \is_object($content) && method_exists($content, 'getId'):
                $return = $content->getId();
                break;
            case \is_object($content) && method_exists($content, '__toString'):
                $return = $content->__toString();
                break;
            case \is_string($content):
                $return = $content;
                break;
        }

        return $return;
    }

    /**
     * getCurrentContentId.
     *
     * @return string|int|null
     */
    protected function getCurrentContentId()
    {
        $root = $this->getRoot();
        if ($this->getRoot() === $this) {
            return null;
        }

        return $root->getCurrentContentId();
    }

    /**
     * isCurrent.
     *
     * @param string|int|null $currentContentId
     */
    public function isCurrent($currentContentId = null): bool
    {
        if (null === $currentContentId) {
            $currentContentId = $this->getRoot()->getCurrentContentId();
        }

        if (null === $currentContentId) {
            return false;
        }

        if ($this->getContentId() === $currentContentId) {
            return true;
        }

        foreach ($this as $child) {
            if ($child->isCurrent($currentContentId)) {
                return true;
            }
        }

        return false;
    }
}
