<?php declare(strict_types=1);

namespace Woda\MessageBus\EventBus;

use SimpleBus\Message\Bus\MessageBus;

final class SimpleBusEventBus implements EventBus
{
    private MessageBus $messageBus;

    public function __construct(MessageBus $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function handle(object $message): void
    {
        $this->messageBus->handle($message);
    }
}
