<?php declare(strict_types=1);

namespace WodaTest\MessageBus\Unit;

use PHPUnit\Framework\TestCase;
use stdClass;
use Woda\MessageBus\EventBus\SimpleBusEventBus;
use Woda\MessageBus\EventBus\SpyEventBus;
use Woda\MessageBus\SpyBus;
use Woda\MessageBus\SpySimpleBusMessageBus;

class EventBusTest extends TestCase
{
    public function testSimpleBusCommandBus(): void
    {
        $message = new stdClass();
        $spy = new SpySimpleBusMessageBus();
        $bus = new SimpleBusEventBus($spy);

        $bus->handle($message);

        $this->assertContains($message, $spy->getHandledMessages());
    }

    public function testSpyEventBus(): void
    {
        $message = new stdClass();
        $bus = new SpyEventBus(new SpyBus());

        $bus->handle($message);

        $this->assertContains($message, $bus->getHandledMessages());
    }
}
