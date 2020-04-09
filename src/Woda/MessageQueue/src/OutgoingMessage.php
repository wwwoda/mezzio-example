<?php

declare(strict_types=1);

namespace Woda\MessageQueue;

final class OutgoingMessage
{
    private string $body;

    public function __construct(string $body)
    {
        $this->body = $body;
    }

    public function body(): string
    {
        return $this->body;
    }
}
