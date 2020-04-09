<?php

declare(strict_types=1);

namespace MessageBusTest\Unit\Middleware\Queue;

use MessageBus\Middleware\Queue\ClassNames;
use MessageBus\Middleware\Queue\MessageQueueMiddleware;
use MessageBus\Middleware\Queue\MessageSerializer;
use MessageBus\Middleware\Queue\SerializedMessageBuilder;
use MessageBusTest\Unit\TestDouble\SpyQueue;
use MessageBusTest\Unit\TestDouble\TestObject;
use PHPUnit\Framework\TestCase;

use function get_class;

final class MessageQueueMiddlewareTest extends TestCase
{
    /** @var SpyQueue */
    private $queue;
    /** @var ClassNames */
    private $classNames;
    /** @var null|bool */
    private $wasCalled;
    /** @var MessageSerializer */
    private $serializer;

    public function testUnregisteredMessageIsIgnored(): void
    {
        $object = new TestObject();

        $this->middleware()->handle(
            $object,
            function () {
                $this->wasCalled = true;
            }
        );

        $this->assertCount(0, $this->queue->getPublishedMessages());
    }

    private function middleware(): MessageQueueMiddleware
    {
        return new MessageQueueMiddleware(
            $this->classNames,
            new SerializedMessageBuilder($this->serializer),
            $this->queue
        );
    }

    public function testRegisteredMessageIsQueued(): void
    {
        $object = new TestObject();
        $this->classNames = new ClassNames(get_class($object));

        $this->middleware()->handle(
            $object,
            function () {
                $this->wasCalled = true;
            }
        );

        $this->assertCount(1, $this->queue->getPublishedMessages());
    }

    public function testQueuedMessageIsCorrect(): void
    {
        $object = new TestObject();
        $expected = $this->serializer->serialize($object);
        $this->classNames = new ClassNames(get_class($object));

        $this->middleware()->handle(
            $object,
            function () {
                $this->wasCalled = true;
            }
        );

        $messages = $this->queue->getPublishedMessages();
        $this->assertSame($expected, $messages[0]->body());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->queue = new SpyQueue();
        $this->classNames = new ClassNames();
        $this->serializer = new MessageSerializer();
    }
}
