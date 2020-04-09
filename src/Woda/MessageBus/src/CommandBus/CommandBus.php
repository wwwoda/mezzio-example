<?php declare(strict_types=1);

namespace Woda\MessageBus\CommandBus;

interface CommandBus
{
    public const KEY = 'command_bus';
    public function handle(object $message): void;
}
