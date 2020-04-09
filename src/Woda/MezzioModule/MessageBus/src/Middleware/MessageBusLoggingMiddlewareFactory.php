<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\Middleware;

class MessageBusLoggingMiddlewareFactory extends AbstractMongoDbLoggingMiddlewareFactory
{
    protected function getLoggerName(): string
    {
        return 'message_bus';
    }

    protected function getCollection(): string
    {
        return 'message_bus_log';
    }
}
