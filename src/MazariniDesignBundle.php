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

namespace Mazarini\DesignBundle;

use Mazarini\DesignBundle\Controller\DesignController;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class MazariniDesignBundle extends AbstractBundle
{
    public function configure(DefinitionConfigurator $definition): void
    {
        $rootNode = $definition->rootNode();
        $method = 'children';
        if (!method_exists($rootNode, $method)) {
            throw new \LogicException(sprintf('object "%s" don\'t have method "%s"', $rootNode::class, $method));
        }
        $rootNode
            ->$method()
                ->scalarNode('template_dir')->defaultValue('templates')->info('template dir, "templates" by default')->end()
                ->scalarNode('theme_dir')->defaultValue('theme')->info('theme subdir under template dir, "theme" by default')->end()
            ->end()
        ;
    }

    /**
     * @param array<string,string> $config
     */
    public function loadExtension(array $config, ContainerConfigurator $configurator, ContainerBuilder $builder): void
    {
        // load an XML, PHP or Yaml file
        $configurator->import('Resources/config/services.yaml');

        $template = $this->getPath().\DIRECTORY_SEPARATOR.$config['template_dir'];
        if (!is_dir($template)) {
            throw new \ErrorException(sprintf('Config error "template_dir: %s" don\'t exists (%s)', $config['template_dir'], $template));
        }
        $theme = $template.\DIRECTORY_SEPARATOR.$config['theme_dir'];
        if (!is_dir($theme)) {
            throw new \ErrorException(sprintf('Config error "theme_dir: %s" don\'t exists (%s)', $config['theme_dir'], $theme));
        }
        $designController = $builder->getDefinition(DesignController::class);
        $designController->addMethodCall('setTheme', [$theme]);
        $designController->addMethodCall('setTemplate', [$template]);
    }
}
