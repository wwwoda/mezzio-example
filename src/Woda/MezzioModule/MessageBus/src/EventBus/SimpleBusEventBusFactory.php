<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\EventBus;

use Psr\Container\ContainerInterface;
use Woda\MessageBus\EventBus\EventBus;
use Woda\MessageBus\EventBus\SimpleBusEventBus;
use Woda\MezzioModule\MessageBus\MessageBusMiddlewareFactory;

final class SimpleBusEventBusFactory
{
    public function __invoke(ContainerInterface $container): SimpleBusEventBus
    {
        return new SimpleBusEventBus(MessageBusMiddlewareFactory::fromContainer($container, EventBus::KEY));
    }
}
