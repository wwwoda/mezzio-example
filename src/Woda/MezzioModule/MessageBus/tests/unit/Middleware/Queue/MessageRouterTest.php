<?php

declare(strict_types=1);

namespace MessageBusTest\Unit\Middleware\Queue;

use ArrayIterator;
use LogicException;
use MessageBus\Middleware\Queue\MessageRouter;
use MessageBusTest\Unit\TestDouble\SpyMessageBus;
use PHPUnit\Framework\TestCase;

use function get_class;

final class MessageRouterTest extends TestCase
{
    /** @var SpyMessageBus */
    private $eventBus;
    /** @var SpyMessageBus */
    private $commandBus;

    public function testMessageRoutesToCorrectEventBus(): void
    {
        $mock = $this->createMock(ArrayIterator::class);
        $config = $this->config([$mock]);

        $this->messageRouter($config)->bus($mock)->handle($mock);

        $this->assertCount(1, $this->eventBus->getHandledMessages());
    }

    private function config(array $eventBus = [], array $commandBus = []): array
    {
        return ['event_bus' => $this->mockConfig($eventBus), 'command_bus' => $this->mockConfig($commandBus)];
    }

    private function mockConfig(array $eventBus = []): array
    {
        $config = [];
        foreach ($eventBus as $object) {
            $config[get_class($object)] = $object;
        }
        return $config;
    }

    private function messageRouter(array $mapping): MessageRouter
    {
        return new MessageRouter(
            $mapping,
            $this->eventBus,
            $this->commandBus
        );
    }

    public function testMessageRoutesToCorrectCommandBus(): void
    {
        $mock = $this->createMock(ArrayIterator::class);
        $config = $this->config([], [$mock]);

        $this->messageRouter($config)->bus($mock)->handle($mock);

        $this->assertCount(1, $this->commandBus->getHandledMessages());
    }

    public function testNoRoutingForMessageThrowsException(): void
    {
        $mock = $this->createMock(ArrayIterator::class);

        $this->expectException(LogicException::class);
        $this->expectExceptionMessageRegExp('/^Job cant be executed no mapping registered for/');

        $this->messageRouter($this->config())->bus($mock)->handle($mock);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->eventBus = new SpyMessageBus();
        $this->commandBus = new SpyMessageBus();
    }
}
