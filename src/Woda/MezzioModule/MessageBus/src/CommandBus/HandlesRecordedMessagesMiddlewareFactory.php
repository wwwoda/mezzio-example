<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\CommandBus;

use Interop\Container\ContainerInterface;
use SimpleBus\Message\Recorder\HandlesRecordedMessagesMiddleware;
use SimpleBus\Message\Recorder\PublicMessageRecorder;
use Woda\MessageBus\EventBus\EventBusInterface;
use Woda\MezzioModule\MessageBus\MessageBusMiddlewareFactory;

class HandlesRecordedMessagesMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): HandlesRecordedMessagesMiddleware
    {
        return new HandlesRecordedMessagesMiddleware(
            $container->get(PublicMessageRecorder::class),
            MessageBusMiddlewareFactory::fromContainer($container, EventBusInterface::KEY)
        );
    }
}
