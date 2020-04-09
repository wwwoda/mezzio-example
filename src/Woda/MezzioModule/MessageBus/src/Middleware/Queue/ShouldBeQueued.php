<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\Middleware\Queue;

interface ShouldBeQueued
{
    public function __invoke($message): bool;
}
