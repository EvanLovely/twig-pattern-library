<?php

namespace Phase2\TwigPlBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {

        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('twig_pl');

        $rootNode
            ->children()
                ->scalarNode('testkey')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
