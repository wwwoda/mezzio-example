<?php declare(strict_types=1);

namespace Woda\MessageBus\EventBus;

interface EventBus
{
    public const KEY = 'event_bus';
    public function handle(object $message): void;
}
