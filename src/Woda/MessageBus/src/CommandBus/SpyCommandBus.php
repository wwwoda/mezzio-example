<?php declare(strict_types=1);

namespace Woda\MessageBus\CommandBus;

use Woda\MessageBus\SpyBus;

final class SpyCommandBus implements CommandBus
{
    private SpyBus $spyBus;

    public function __construct(SpyBus $spyBus)
    {
        $this->spyBus = $spyBus;
    }

    public function handle(object $message): void
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
