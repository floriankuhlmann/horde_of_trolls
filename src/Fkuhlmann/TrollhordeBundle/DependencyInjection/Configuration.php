<?php

namespace Fkuhlmann\TrollhordeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fkuhlmann_trollhorde');

        // Here we define the parameters that are allowed to
        // configure the bundle. See the documentation linked above for
        // more information on that topic.

        $rootNode
            ->children()
                ->arrayNode('twitter')
                    ->children()
                        ->arrayNode('target')
                            ->children()
                                ->scalarNode('owner')->end()
                                ->scalarNode('owner_id')->end()
                                ->scalarNode('consumer_key')->end()
                                ->scalarNode('consumer_secret')->end()
                                ->scalarNode('access_token')->end()
                                ->scalarNode('access_token_secret')->end()
                            ->end()
                        ->end()
                        ->arrayNode('bots')
                            ->prototype('array')
                                ->children()
                                    ->scalarNode('owner')->end()
                                    ->scalarNode('owner_id')->end()
                                    ->scalarNode('consumer_key')->end()
                                    ->scalarNode('consumer_secret')->end()
                                    ->scalarNode('access_token')->end()
                                    ->scalarNode('access_token_secret')->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
