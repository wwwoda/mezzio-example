<?php declare(strict_types=1);

namespace WodaTest\Unit\MessageBus\Unit;

use PHPUnit\Framework\TestCase;
use SimpleBus\Message\Bus\MessageBus;
use Woda\MessageBus\EventBus\SimpleBusEventBus;
use Woda\MessageBus\EventBus\SpyEventBus;
use Woda\MessageBus\SpyBus;

class EventBusTest extends TestCase
{
    public function testRead(): void
    {
        $message = new \stdClass();
        $messageBusProphecy = $this->prophesize(MessageBus::class);
        $bus = new SimpleBusEventBus($messageBusProphecy->reveal());

        $bus->handle($message);

        $messageBusProphecy->handle($message)->shouldHaveBeenCalled();
    }

    public function testSpyCommandBus(): void
    {
        $message = new \stdClass();
        $bus = new SpyEventBus(new SpyBus());

        $bus->handle($message);

        $this->assertContains($message, $bus->getHandledMessages());
    }
}
