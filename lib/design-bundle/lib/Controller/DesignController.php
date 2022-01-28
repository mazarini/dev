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

use Mazarini\DesignBundle\Tree\Template;
use Mazarini\DesignBundle\Tree\TemplateNode;
use Mazarini\ToolsBundle\Utility\Folder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

abstract class DesignController extends AbstractController
{
    private array $data = [];

    public function renderDesignTemplate(Folder $folder, string $group, string $template = null): Response
    {
        $root = $folder->getTemplateRoot('design');
        $tree = new TemplateNode($root, $group);

        if (null === $template) {
            $template = $this->getFirstTemplate($tree);
        }
        $template = 'design/'.$template;
        $template = str_replace(\DIRECTORY_SEPARATOR, '/', $template);

        $this->addData('design_menu', $tree)
             ->addData('design_template', $template)
        ;

        return $this->render($template, $this->data);
    }

    protected function addData($name, $value): self
    {
        $this->data[$name] = $value;

        return $this;
    }

    protected function getFirstTemplate(TemplateNode $nodes): ?string
    {
        foreach ($nodes as $node) {
            if (Template::class === $node->getContent()::class) {
                $template = $node->getContent()->getTemplate();
            } else {
                $template = $this->getFirstTemplate($node);
            }
            if (null !== $template) {
                return $template;
            }
        }

        return null;
    }
}
