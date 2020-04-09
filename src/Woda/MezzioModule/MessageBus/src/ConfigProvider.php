<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus;

use SimpleBus\Message\Bus\Middleware\FinishesHandlingMessageBeforeHandlingNext;
use SimpleBus\Message\Handler\DelegatesToMessageHandlerMiddleware;
use SimpleBus\Message\Recorder\HandlesRecordedMessagesMiddleware;
use SimpleBus\Message\Subscriber\NotifiesMessageSubscribersMiddleware;
use Woda\MezzioModule\Config\MezzioModuleConfig;

final class ConfigProvider
{
    private const NAME = 'message-bus';

    public function __invoke(): array
    {
        return MezzioModuleConfig::forModule(self::NAME)
            ->withTemplatePath(__DIR__ . '/../templates/')
            ->withConfigFolder(__DIR__ . '/../config/')
            //->withDoctrineOrmMapping(__DIR__ . '/../mapping/', __NAMESPACE__)
            ->withRouteProvider(MessageBusRouter::class)
            ->withConfig(
                [
                    'message_bus' => $this->buildMessageBusConfig(),
                    'command_bus' => $this->buildCommandBusConfig(),
                    'event_bus' => $this->buildEventBusConfig(),
                ]
            )
            ->toArray();
    }

    private function buildMessageBusConfig()
    {
        return [
            'async' => true,
            'async_messages' => [],
        ];
    }

    private function buildCommandBusConfig()
    {
        return [
            'middlewares' => [
                HandlesRecordedMessagesMiddleware::class => HandlesRecordedMessagesMiddleware::class,
                DelegatesToMessageHandlerMiddleware::class => DelegatesToMessageHandlerMiddleware::class,
            ],
            'mapping' => [],
            'mapping_provider' => [],
        ];
    }

    private function buildEventBusConfig()
    {
        return [
            'middlewares' => [
                FinishesHandlingMessageBeforeHandlingNext::class => FinishesHandlingMessageBeforeHandlingNext::class,
                NotifiesMessageSubscribersMiddleware::class => NotifiesMessageSubscribersMiddleware::class,
            ],
            'mapping' => [],
            'mapping_provider' => [],
        ];
    }
}
