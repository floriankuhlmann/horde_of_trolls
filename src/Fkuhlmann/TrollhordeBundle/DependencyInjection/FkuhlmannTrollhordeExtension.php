<?php

namespace Fkuhlmann\TrollhordeBundle\DependencyInjection;
use Fkuhlmann\TrollhordeBundle\Helper\YamlLoader;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\Config\Loader\DelegatingLoader;



/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class FkuhlmannTrollhordeExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {

        /* setup the filelocator for the path to resources for this extension*/

        $configDirectories = array(__DIR__.'/../Resources/config');
        $locator = new FileLocator($configDirectories);

        /* loading the bundle specific services */
        $loader = new YamlFileLoader($container, $locator);
        $loader->load('services.yml');


        /* loading the configurations for the twitter account */
        $yamlTwitterFile = $locator->locate('twitter.yml', null, true);

        /* we need a configuration object */
        $configuration = new Configuration();

        /* now resolve the loader and load the file */
        $loaderResolver = new LoaderResolver(array(new YamlLoader($locator)));
        $delegatingLoader = new DelegatingLoader($loaderResolver);
        $configs = $delegatingLoader->load($yamlTwitterFile);

        /* lets put the data form the yaml-file into the configuration object */
        $config = $this->processConfiguration($configuration, $configs);

        /*
            putting the config parameters in the container
            https://devblog.pedro.resende.biz/symfony-s-friendly-configuration-bundle/
            https://theghostwhocodes.com/symfony-how-to-use-configuration-parameters-from-config-yml-ce2b74359098#.gyenme1l8
        */

        $container->setParameter('fkuhlmann_trollhorde.twitter', $config['twitter']);
        $container->setParameter('fkuhlmann_trollhorde.twitter.target', $config['twitter']['target']);
        $container->setParameter('fkuhlmann_trollhorde.twitter.bots', $config['twitter']['bots']);

    }



}
