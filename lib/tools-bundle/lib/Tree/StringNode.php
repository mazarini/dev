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
 * @method         __construct(string $content)
 * @method string  getContent()
 * @method ?string getContentId()
 * @method ?string getCurrentContentId()
 * @method bool    isCurrent(?string $currentContentId)
 */
class StringNode extends ContentNode
{
    /**
     * getContentId.
     *
     * @return ?string
     */
    protected function getContentId()
    {
        return $this->getContent();
    }
}
