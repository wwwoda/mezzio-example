<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\Middleware;

class EventBusLoggingMiddlewareFactory extends AbstractMongoDbLoggingMiddlewareFactory
{
    protected function getLoggerName(): string
    {
        return 'event_bus';
    }

    protected function getCollection(): string
    {
        return 'event_bus_log';
    }
}
