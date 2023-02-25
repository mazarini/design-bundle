<?php

/**
 * This file is part of mazarini/design-bundle.
 *
 * mazarini/design-bundle is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * mazarini/design-bundle is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License
 * for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with mazarini/design-bundle. If not, see <https://www.gnu.org/licenses/>.
 *
 * @package mazarini/design-bundle
 */

namespace Mazarini\DesignBundle\Controller;

use Mazarini\DesignBundle\Util\Folder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DesignController extends AbstractController
{
    private string $template;
    private string $theme;

    #[Route('/', name: 'mazarini_design_index')]
    public function index(): Response
    {
        $tree = new Folder($this->template, $this->theme);

        return $this->render('@MazariniDesign/design/index.html.twig', [
            'tree' => $tree,
        ]);
    }

    /**
     * Set the value of template.
     */
    public function setTemplate(string $template): self
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Set the value of theme.
     */
    public function setTheme(string $theme): self
    {
        $this->theme = $theme;

        return $this;
    }
}
