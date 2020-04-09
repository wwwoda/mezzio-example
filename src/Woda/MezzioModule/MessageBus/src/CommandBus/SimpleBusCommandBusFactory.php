<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\CommandBus;

use Psr\Container\ContainerInterface;
use Woda\MessageBus\CommandBus\CommandBus;
use Woda\MessageBus\CommandBus\SimpleBusCommandBus;
use Woda\MezzioModule\MessageBus\MessageBusMiddlewareFactory;

final class SimpleBusCommandBusFactory
{
    public function __invoke(ContainerInterface $container): SimpleBusCommandBus
    {
        return new SimpleBusCommandBus(MessageBusMiddlewareFactory::fromContainer($container, CommandBus::KEY));
    }
}
