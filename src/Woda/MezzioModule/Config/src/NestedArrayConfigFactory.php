<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Config;

use Psr\Container\ContainerInterface;

final class NestedArrayConfigFactory
{
    public function __invoke(ContainerInterface $container): NestedArrayConfig
    {
        return new NestedArrayConfig($container->get('config'));
    }
}
