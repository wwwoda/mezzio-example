<?php declare(strict_types=1);

namespace Woda\MessageBus\EventBus;

interface EventBusInterface
{
    public const KEY = 'event_bus';
    public function handle(object $message): void;
}
