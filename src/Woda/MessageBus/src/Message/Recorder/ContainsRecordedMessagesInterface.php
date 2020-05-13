<?php declare(strict_types=1);

namespace Woda\MessageBus\Message\Recorder;

interface ContainsRecordedMessagesInterface
{
    /**
     * @return object[]
     */
    public function recordedMessages(): array;
    public function eraseMessages(): void;
}
