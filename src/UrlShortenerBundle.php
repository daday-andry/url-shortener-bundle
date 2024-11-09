<?php
/**
 * @ Author: Daday ANDRY
 * @ Create Time: 2023-08-10 21:05:56
 * @ Modified by: Daday ANDRY
 * @ Modified time: 2024-11-08 22:57:09
 * @ Description:
 */

namespace Daday\UrlShortenerBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class UrlShortenerBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
    }
}
