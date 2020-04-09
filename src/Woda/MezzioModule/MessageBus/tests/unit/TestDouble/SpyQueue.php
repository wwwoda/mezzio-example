<?php

declare(strict_types=1);

namespace MessageBusTest\Unit\TestDouble;

final class SpyQueue implements QueueInterface
{
    /** @var OutgoingMessage[] */
    private $publishedMessages = [];

    public function publish(OutgoingMessage $message): void
    {
        $this->publishedMessages[] = $message;
    }

    public function consume(callable $callback): void
    {
        $callback();
    }

    /**
     * @return OutgoingMessage[]
     */
    public function getPublishedMessages(): array
    {
        return $this->publishedMessages;
    }
}
