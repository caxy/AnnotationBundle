<?php

namespace Caxy\AnnotationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $defaults = $this->getAnnotatorDefaults();

        $treeBuilder = new TreeBuilder();

        return $treeBuilder
            ->root('caxy_annotation', 'array')
                ->children()
                    ->scalarNode('selector')
                        ->defaultValue($defaults['selector'])
                    ->end()
                    ->arrayNode('plugins')
                        ->prototype('scalar')->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Get default configuration of the each instance of editor.
     *
     * @return array
     */
    private function getAnnotatorDefaults()
    {
        return array(
            'selector' => '.annotator',
        );
    }
}
