<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\EventBus;

use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\Stdlib\ArrayUtils;
use Psr\Container\ContainerInterface;
use Woda\MezzioModule\Config\AppConfig;

final class EventBusMappingFactory
{
    public function __invoke(ContainerInterface $container): EventBusMapping
    {
        $mappingProvider = AppConfig::fromContainer($container)->array('event_bus/mapping_provider');
        return new EventBusMapping(
            ArrayUtils::merge(
                AppConfig::fromContainer($container)->array('event_bus/mapping'),
                (new ConfigAggregator($mappingProvider))->getMergedConfig()
            )
        );
    }
}
