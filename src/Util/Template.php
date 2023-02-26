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

namespace Mazarini\DesignBundle\Util;

class Template
{
    private string $template;
    private string $label;
    private Folder $parent;

    public function __construct(string $root, string $template)
    {
        $this->template = substr($template, \strlen($root) + 1);
        $this->template = substr($this->template, 0, \strlen($this->template) - 5);
        $this->label = substr(basename($template, '.html.twig'), 3);
    }

    /**
     * Get the value of template.
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * Get the value of template.
     */
    public function getSlug(): string
    {
        return $this->template;
    }

    /**
     * Get the value of slug.
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Get the value of parent.
     */
    public function getParent(): Folder
    {
        return $this->parent;
    }

    /**
     * Set the value of parent.
     */
    public function setParent(Folder $parent): self
    {
        $this->parent = $parent;

        return $this;
    }
}
