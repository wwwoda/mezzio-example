<?php declare(strict_types=1);

namespace WodaTest\MessageBus\Unit;

use PHPUnit\Framework\TestCase;
use SimpleBus\Message\Bus\MessageBus;
use stdClass;
use Woda\MessageBus\CommandBus\SimpleBusCommandBus;
use Woda\MessageBus\CommandBus\SpyCommandBus;
use Woda\MessageBus\SpyBus;

class CommandBusTest extends TestCase
{
    public function testRead(): void
    {
        $message = new stdClass();
        $messageBusProphecy = $this->prophesize(MessageBus::class);
        $bus = new SimpleBusCommandBus($messageBusProphecy->reveal());

        $bus->handle($message);

        $messageBusProphecy->handle($message)->shouldHaveBeenCalled();
    }

    public function testSpyCommandBus(): void
    {
        $message = new stdClass();
        $bus = new SpyCommandBus(new SpyBus());

        $bus->handle($message);

        $this->assertContains($message, $bus->getHandledMessages());
    }
}
