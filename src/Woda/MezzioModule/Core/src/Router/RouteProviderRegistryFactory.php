<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Core\Router;

use Psr\Container\ContainerInterface;
use Woda\MezzioModule\Config\Config;

use function array_map;

final class RouteProviderRegistryFactory
{
    public function __invoke(ContainerInterface $container): RouteProviderRegistry
    {
        return new RouteProviderRegistry(
            ...array_map(
                   function (string $serviceName) use ($container): RouteProviderInterface {
                       return $container->get($serviceName);
                   },
                   $this->config($container)->array('woda/route_provider')
               )
        );
    }

    private function config(ContainerInterface $container): Config
    {
        return $container->get(Config::class);
    }
}
