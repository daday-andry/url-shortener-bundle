<?php
/**
 * @ Author: Daday ANDRY
 * @ Create Time: 2022-11-12 19:25:03
 * @ Modified by: Daday ANDRY
 * @ Modified time: 2024-11-08 22:36:48
 * @ Description:
 */

namespace Daday\UrlShortenerBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class UrlShortenerExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');
    }
}
