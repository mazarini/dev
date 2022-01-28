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

use Mazarini\DesignBundle\Controller\DesignController;
use Mazarini\ToolsBundle\Utility\Folder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ThemeController extends DesignController
{
    #[Route('/theme/{template}', name: 'design', requirements: ['template' => '.+'])]
    public function index(Folder $folder, string $template = null): Response
    {
        return $this->renderDesignTemplate($folder, '01-Design', $template);
    }
}
