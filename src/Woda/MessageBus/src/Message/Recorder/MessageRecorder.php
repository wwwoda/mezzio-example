<?php declare(strict_types=1);

namespace Woda\MessageBus\Message\Recorder;

interface MessageRecorder extends ContainsRecordedMessages
{
    public function record(object $message): void;
}
