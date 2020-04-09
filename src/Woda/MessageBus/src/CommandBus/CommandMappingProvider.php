<?php declare(strict_types=1);

namespace Woda\MessageBus\CommandBus;

interface CommandMappingProvider
{
    /**
     * Format: [Command::class => Handler::class, AnotherCommand::class => AnotherHandler::class]
     * @return array<string, string>
     */
    public function __invoke(): array;
}
