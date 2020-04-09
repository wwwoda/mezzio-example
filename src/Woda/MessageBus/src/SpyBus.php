<?php declare(strict_types=1);

namespace Woda\MessageBus;

final class SpyBus
{
    /** @var object[] */
    private array $handledMessages = [];

    public function handle(object $message): void
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
