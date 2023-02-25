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

use ArrayObject;

/**
 * @extends ArrayObject<string,Template|Folder>
 */
class Folder extends \ArrayObject
{
    private string $folder;
    private string $label;
    private Folder $parent;

    public function __construct(string $root, string $folder)
    {
        $this->folder = substr($folder, \strlen($root));
        $this->label = substr(basename($folder), 3);
        $scandir = scandir($folder);
        if (\is_array($scandir)) {
            foreach ($scandir as $path) {
                if (true === mb_ereg('\A([0-9]{2})(\-)(.*)\z', basename($path))) {
                    $name = $folder.\DIRECTORY_SEPARATOR.$path;
                    $child = is_dir($name) ? new self($root, $name) : new Template($root, $name);
                    $this[$child->getSlug()] = $child->setParent($this);
                }
            }
        }
    }

    /**
     * Get the value of folder.
     */
    public function getFolder(): string
    {
        return $this->folder;
    }

    /**
     * Get the value of folder.
     */
    public function getSlug(): string
    {
        return $this->folder;
    }

    /**
     * Get the value of label.
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Get the value of parent.
     */
    public function getParent(): self
    {
        return $this->parent;
    }

    /**
     * Set the value of parent.
     */
    public function setParent(self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }
}
