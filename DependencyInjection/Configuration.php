<?php

namespace Club\ExtraBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
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
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('club_extra');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        $rootNode
            ->children()
                ->scalarNode('facebook')->defaultValue(true)->end()
                ->scalarNode('twitter')->defaultValue(true)->end()
                ->scalarNode('googleplus')->defaultValue(true)->end()
                ->scalarNode('google_maps_key')->defaultValue(false)->end()
                ->scalarNode('google_geocode_output_format')->defaultValue('json')->end()
                ->scalarNode('google_geocode_key')->defaultValue('12345678')->end()
            ->end();

        return $treeBuilder;
    }
}
