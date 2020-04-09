<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\CommandBus;

use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\Stdlib\ArrayUtils;
use Psr\Container\ContainerInterface;
use Woda\MezzioModule\Config\AppConfig;

final class CommandBusMappingFactory
{
    public function __invoke(ContainerInterface $container): CommandBusMapping
    {
        $mappingProvider = AppConfig::fromContainer($container)->array('command_bus/mapping_provider');
        return new CommandBusMapping(
            ArrayUtils::merge(
                AppConfig::fromContainer($container)->array('command_bus/mapping'),
                (new ConfigAggregator($mappingProvider))->getMergedConfig()
            )
        );
    }
}
