<?php declare(strict_types=1);

namespace Woda\MessageBus\Message\Recorder;

use SimpleBus\Message\Recorder\RecordsMessages as SimpleBusRecordsMessages;

class SimpleBusMessageRecorder implements MessageRecorder
{
    private SimpleBusRecordsMessages $messageRecorder;

    public function __construct(SimpleBusRecordsMessages $messageRecorder)
    {
        $this->messageRecorder = $messageRecorder;
    }

    /**
     * @return object[]
     */
    public function recordedMessages(): array
    {
        return $this->messageRecorder->recordedMessages();
    }

    public function eraseMessages(): void
    {
        $this->messageRecorder->eraseMessages();
    }

    public function record(object $message): void
    {
        $this->messageRecorder->record($message);
    }
}
