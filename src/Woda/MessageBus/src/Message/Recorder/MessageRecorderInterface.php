<?php declare(strict_types=1);

namespace Woda\MessageBus\Message\Recorder;

interface MessageRecorderInterface extends ContainsRecordedMessagesInterface
{
    public function record(object $message): void;
}
