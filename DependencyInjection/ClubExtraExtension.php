<?php

namespace Club\ExtraBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ClubExtraExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $loader->load('twig.yml');

        $container->setParameter('club_extra.facebook', $config['facebook']);
        $container->setParameter('club_extra.twitter', $config['twitter']);
        $container->setParameter('club_extra.googleplus', $config['googleplus']);
        $container->setParameter('club_extra.google_maps_key', $config['google_maps_key']);
        $container->setParameter('club_extra.google_geocode_output_format', $config['google_geocode_output_format']);
        $container->setParameter('club_extra.google_geocode_key', $config['google_geocode_key']);
    }
}
