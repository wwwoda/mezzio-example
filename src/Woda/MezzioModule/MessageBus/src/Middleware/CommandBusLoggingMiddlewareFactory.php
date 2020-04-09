<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\Middleware;

class CommandBusLoggingMiddlewareFactory extends AbstractMongoDbLoggingMiddlewareFactory
{
    protected function getLoggerName(): string
    {
        return 'command_bus';
    }

    protected function getCollection(): string
    {
        return 'command_bus_log';
    }
}
