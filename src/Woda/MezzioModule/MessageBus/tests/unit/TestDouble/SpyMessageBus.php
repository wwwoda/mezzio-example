<?php

declare(strict_types=1);

namespace MessageBusTest\Unit\TestDouble;

use SimpleBus\Message\Bus\MessageBus;

final class SpyMessageBus implements MessageBus
{
    /** @var object[] */
    private $handledMessages = [];

    public function handle($message): void
    {
        $this->handledMessages[] = $message;
    }

    /**
     * @return object[]
     */
    public function getHandledMessages(): array
    {
        return $this->handledMessages;
    }
}
