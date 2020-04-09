<?php

declare(strict_types=1);

namespace Woda\MessageQueue;

final class MemoryQueue implements Queue
{
    /** @var OutgoingMessage[] */
    private array $messages = [];
    private bool $isStopped = false;

    public function publish(OutgoingMessage $message): void
    {
        $this->messages[] = $message;
    }

    public function consume(callable $callback): void
    {
        while (true) {
            if ($this->isStopped) {
                break;
            }
            foreach ($this->messages as $index => $message) {
                $callback(
                    new IncomingMessage(
                        $message->body(),
                        function () use ($index): void {
                            unset($this->messages[$index]);
                        }
                    )
                );
            }
        }
    }

    public function stop(): void
    {
        $this->isStopped = true;
    }
}
