<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Core\Router;

use Psr\Container\ContainerInterface;
use Woda\MezzioModule\Config\AppConfig;

use function array_map;

final class RouteProviderRegistryFactory
{
    public function __invoke(ContainerInterface $container): RouteProviderRegistry
    {
        return new RouteProviderRegistry(
            ...array_map(
                   function (string $serviceName) use ($container): RouteProvider {
                       return $container->get($serviceName);
                   },
                   AppConfig::fromContainer($container)->array('woda/router/route_provider')
               )
        );
    }
}
