<?php declare(strict_types=1);

namespace Woda\MessageBus;

use SimpleBus\Message\Bus\MessageBus;

final class SpySimpleBusMessageBus implements MessageBus
{
    private SpyBus $spyBus;

    public function __construct()
    {
        $this->spyBus = new SpyBus();
    }

    public function handle($message)
    {
        $this->spyBus->handle($message);
    }

    /**
     * @return object[]
     */
    public function getHandledMessages(): array
    {
        return $this->spyBus->getHandledMessages();
    }
}
