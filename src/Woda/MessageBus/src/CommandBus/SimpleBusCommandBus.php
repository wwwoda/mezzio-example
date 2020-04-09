<?php declare(strict_types=1);

namespace Woda\MessageBus\CommandBus;

use SimpleBus\Message\Bus\MessageBus;

final class SimpleBusCommandBus implements CommandBus
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
