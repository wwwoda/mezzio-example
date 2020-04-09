<?php

declare(strict_types=1);

namespace Woda\MessageQueue;

interface Queue
{
    public function publish(OutgoingMessage $message): void;

    public function consume(callable $callback): void;
}
