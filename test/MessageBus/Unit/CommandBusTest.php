<?php declare(strict_types=1);

namespace WodaTest\MessageBus\Unit;

use PHPUnit\Framework\TestCase;
use stdClass;
use Woda\MessageBus\CommandBus\SimpleBusCommandBus;
use Woda\MessageBus\CommandBus\SpyCommandBus;
use Woda\MessageBus\SpySimpleBusMessageBus;

class CommandBusTest extends TestCase
{
    public function testSimpleBusCommandBus(): void
    {
        $message = new stdClass();
        $spy = new SpySimpleBusMessageBus();
        $bus = new SimpleBusCommandBus($spy);

        $bus->handle($message);

        $this->assertContains($message, $spy->getHandledMessages());
    }

    public function testSpyCommandBus(): void
    {
        $message = new stdClass();
        $bus = new SpyCommandBus();

        $bus->handle($message);

        $this->assertContains($message, $bus->getHandledMessages());
    }
}
