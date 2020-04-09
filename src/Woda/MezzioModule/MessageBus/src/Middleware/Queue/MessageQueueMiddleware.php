<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\Middleware\Queue;

use SimpleBus\Message\Bus\Middleware\MessageBusMiddleware;
use Woda\MessageQueue\Queue;

final class MessageQueueMiddleware implements MessageBusMiddleware
{
    /** @var ShouldBeQueued */
    private $shouldBeQueued;
    /** @var MessageBuilder */
    private $messageBuilder;
    /** @var Queue */
    private $queue;

    public function __construct(
        ShouldBeQueued $shouldBeQueued,
        MessageBuilder $messageBuilder,
        Queue $queue
    ) {
        $this->shouldBeQueued = $shouldBeQueued;
        $this->messageBuilder = $messageBuilder;
        $this->queue = $queue;
    }

    public function handle($message, callable $next): void
    {
        if (!$this->shouldBeQueued($message)) {
            $next($message);
            return;
        }
        $this->queue($message);
    }

    private function shouldBeQueued($message): bool
    {
        return ($this->shouldBeQueued)($message);
    }

    private function queue($message): void
    {
        $this->queue->publish($this->messageBuilder->build($message));
    }
}
