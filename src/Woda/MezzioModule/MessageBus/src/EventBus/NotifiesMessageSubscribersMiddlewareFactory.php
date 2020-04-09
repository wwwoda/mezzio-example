<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\EventBus;

use Interop\Container\ContainerInterface;
use SimpleBus\Message\CallableResolver\CallableCollection;
use SimpleBus\Message\CallableResolver\ServiceLocatorAwareCallableResolver;
use SimpleBus\Message\Name\ClassBasedNameResolver;
use SimpleBus\Message\Subscriber\NotifiesMessageSubscribersMiddleware;
use SimpleBus\Message\Subscriber\Resolver\MessageSubscribersResolver;
use SimpleBus\Message\Subscriber\Resolver\NameBasedMessageSubscriberResolver;

class NotifiesMessageSubscribersMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new NotifiesMessageSubscribersMiddleware($this->createSubscriberResolver($container));
    }

    private function createSubscriberResolver(ContainerInterface $container): MessageSubscribersResolver
    {
        return new NameBasedMessageSubscriberResolver(
            new ClassBasedNameResolver(),
            new CallableCollection(
                $container->get(EventBusMapping::class)(),
                new ServiceLocatorAwareCallableResolver([$container, 'get'])
            )
        );
    }
}
