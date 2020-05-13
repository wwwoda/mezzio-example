<?php declare(strict_types=1);

namespace WodaTest\MessageBus\Unit;

use PHPUnit\Framework\TestCase;
use SimpleBus\Message\Recorder\PublicMessageRecorder;
use stdClass;
use Woda\MessageBus\Message\Recorder\SimpleBusMessageRecorder;

class MessageRecorderTest extends TestCase
{
    public function testMessagesAreRecorded(): void
    {
        $message = new stdClass();
        $bus = new SimpleBusMessageRecorder(new PublicMessageRecorder());

        $bus->record($message);

        $this->assertContains($message, $bus->recordedMessages());
    }

    public function testMessagesAreErased(): void
    {
        $message = new stdClass();
        $bus = new SimpleBusMessageRecorder(new PublicMessageRecorder());
        $bus->record($message);

        $bus->eraseMessages();

        $this->assertEmpty($bus->recordedMessages());
    }
}
