<?php

/*
 * This file is part of the mazarini/dev project.
 *
 * (c) Mazarini <mazarini@protonmail.com.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mazarini\DesignBundle\Controller;

use Mazarini\DesignBundle\Tree\TemplateNode;
use Mazarini\DesignBundle\Tree\TemplateRoot;
use Mazarini\ToolsBundle\Utility\Folder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

abstract class DesignController extends AbstractController
{
    /**
     * $data.
     *
     * @var array<string,mixed>
     */
    private array $data = [];

    public function renderDesignTemplate(Folder $folder, string $group, string $template = null): Response
    {
        $root = $folder->getTemplateRoot('design');
        $tree = new TemplateRoot($root, $group);

        if (null === $template) {
            $template = $this->getFirstTemplate($tree);
        }
        $tree->setCurrentContentId($template);
        $template = 'design/'.$template;
        $template = str_replace(\DIRECTORY_SEPARATOR, '/', $template);

        $this->addData('design_menu', $tree)
             ->addData('design_template', $template)
        ;

        return $this->render($template, $this->data);
    }

    protected function addData(string $name, mixed $value): self
    {
        $this->data[$name] = $value;

        return $this;
    }

    protected function getFirstTemplate(TemplateNode $nodes): string
    {
        foreach ($nodes as $node) {
            $content = $node->getContent();
            if (method_exists($content, 'getTemplate')) {
                $template = $content->getTemplate();
            } else {
                $template = $this->getFirstTemplate($node);
            }
            if (null !== '') {
                return $template;
            }
        }

        return '';
    }
}
