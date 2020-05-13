<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Core\Router;

use Psr\Container\ContainerInterface;
use Woda\MezzioModule\Config\AppConfig;

use function array_map;

final class PipeProviderRegistryFactory
{
    public function __invoke(ContainerInterface $container): PipeProviderRegistry
    {
        return new PipeProviderRegistry(
            ...array_map(
                   function (string $serviceName) use ($container): PipeProvider {
                       return $container->get($serviceName);
                   },
                   AppConfig::fromContainer($container)->array('woda/router/pipe_provider')
               )
        );
    }
}
