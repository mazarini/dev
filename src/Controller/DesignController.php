<?php

/*
 * This file is part of the mazarini/dev project.
 *
 * (c) Mazarini <mazarini@protonmail.com.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use Mazarini\DesignBundle\Tree\TemplateNode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DesignController extends AbstractController
{
    #[Route('/design', name: 'design')]
    public function index(): Response
    {
        $tree = new TemplateNode('/home/mazarini/Workspace/dev/sources'.'/templates', '01-design');

        return $this->render('01-design/01-Initialize/01-index.html.twig', [
            'menu' => $tree,
        ]);
    }
}
