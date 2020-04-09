<?php

declare(strict_types=1);

namespace Woda\MessageQueue;

use Closure;

final class IncomingMessage
{
    private string $body;
    private Closure $ackCallback;

    public function __construct(string $body, Closure $ack)
    {
        $this->body = $body;
        $this->ackCallback = $ack;
    }

    public function body(): string
    {
        return $this->body;
    }

    public function ack(): void
    {
        ($this->ackCallback)();
    }
}
