<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\CommandBus;

use Interop\Container\ContainerInterface;
use SimpleBus\Message\CallableResolver\CallableMap;
use SimpleBus\Message\CallableResolver\ServiceLocatorAwareCallableResolver;
use SimpleBus\Message\Handler\DelegatesToMessageHandlerMiddleware;
use SimpleBus\Message\Handler\Resolver\NameBasedMessageHandlerResolver;
use SimpleBus\Message\Name\ClassBasedNameResolver;

final class DelegatesToMessageHandlerMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): DelegatesToMessageHandlerMiddleware
    {
        return new DelegatesToMessageHandlerMiddleware($this->createHandlerResolver($container));
    }

    private function createHandlerResolver(ContainerInterface $container): NameBasedMessageHandlerResolver
    {
        return new NameBasedMessageHandlerResolver(
            new ClassBasedNameResolver(),
            new CallableMap(
                $container->get(CommandBusMapping::class)(),
                new ServiceLocatorAwareCallableResolver([$container, 'get'])
            )
        );
    }
}
