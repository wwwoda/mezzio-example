<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus;

use SimpleBus\Message\Bus\Middleware\FinishesHandlingMessageBeforeHandlingNext;
use SimpleBus\Message\Handler\DelegatesToMessageHandlerMiddleware;
use SimpleBus\Message\Recorder\HandlesRecordedMessagesMiddleware;
use SimpleBus\Message\Recorder\PublicMessageRecorder;
use SimpleBus\Message\Recorder\RecordsMessages as SimpleBusRecordsMessages;
use SimpleBus\Message\Subscriber\NotifiesMessageSubscribersMiddleware;
use Woda\MessageBus\CommandBus\CommandBus;
use Woda\MessageBus\CommandBus\SimpleBusCommandBus;
use Woda\MessageBus\EventBus\EventBus;
use Woda\MessageBus\EventBus\SimpleBusEventBus;
use Woda\MessageBus\Message\Recorder\MessageRecorder;
use Woda\MessageBus\Message\Recorder\SimpleBusMessageRecorder;
use Woda\MessageQueue\MemoryQueue;
use Woda\MessageQueue\Queue;
use Woda\MezzioModule\MessageBus\CommandBus\CommandBusMapping;
use Woda\MezzioModule\MessageBus\CommandBus\CommandBusMappingFactory;
use Woda\MezzioModule\MessageBus\CommandBus\DelegatesToMessageHandlerMiddlewareFactory;
use Woda\MezzioModule\MessageBus\CommandBus\HandlesRecordedMessagesMiddlewareFactory;
use Woda\MezzioModule\MessageBus\CommandBus\SimpleBusCommandBusFactory;
use Woda\MezzioModule\MessageBus\EventBus\EventBusMapping;
use Woda\MezzioModule\MessageBus\EventBus\EventBusMappingFactory;
use Woda\MezzioModule\MessageBus\EventBus\FinishesHandlingMessageBeforeHandlingNextFactory;
use Woda\MezzioModule\MessageBus\EventBus\NotifiesMessageSubscribersMiddlewareFactory;
use Woda\MezzioModule\MessageBus\EventBus\SimpleBusEventBusFactory;
use Woda\MezzioModule\MessageBus\Middleware\Queue\ClassNames;
use Woda\MezzioModule\MessageBus\Middleware\Queue\ClassNamesFactory;
use Woda\MezzioModule\MessageBus\Middleware\Queue\MessageBuilder;
use Woda\MezzioModule\MessageBus\Middleware\Queue\MessageRouter;
use Woda\MezzioModule\MessageBus\Middleware\Queue\MessageRouterFactory;
use Woda\MezzioModule\MessageBus\Middleware\Queue\SerializedMessageBuilder;
use Woda\MezzioModule\MessageBus\Middleware\Queue\ShouldBeQueued;

return [
    'dependencies' => [
        'aliases' => [
            CommandBus::class => SimpleBusCommandBus::class,
            EventBus::class => SimpleBusEventBus::class,
            MessageBuilder::class => SerializedMessageBuilder::class,
            Queue::class => MemoryQueue::class,
            MessageRecorder::class => SimpleBusMessageRecorder::class,
            ShouldBeQueued::class => ClassNames::class,
            SimpleBusRecordsMessages::class => PublicMessageRecorder::class,
        ],
        'factories' => [
            ClassNames::class => ClassNamesFactory::class,
            CommandBusMapping::class => CommandBusMappingFactory::class,
            DelegatesToMessageHandlerMiddleware::class => DelegatesToMessageHandlerMiddlewareFactory::class,
            FinishesHandlingMessageBeforeHandlingNext::class
            => FinishesHandlingMessageBeforeHandlingNextFactory::class,
            EventBusMapping::class => EventBusMappingFactory::class,
            HandlesRecordedMessagesMiddleware::class => HandlesRecordedMessagesMiddlewareFactory::class,
            MessageRouter::class => MessageRouterFactory::class,
            NotifiesMessageSubscribersMiddleware::class => NotifiesMessageSubscribersMiddlewareFactory::class,
            SimpleBusCommandBus::class => SimpleBusCommandBusFactory::class,
            SimpleBusEventBus::class => SimpleBusEventBusFactory::class,
        ],
    ],
];
