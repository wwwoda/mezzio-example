<?php

declare(strict_types=1);

namespace MessageBusTest\Unit\Middleware\Queue;

use MessageBus\Middleware\Queue\MessageSerializer;
use MessageBus\Middleware\Queue\SerializedMessageBuilder;
use MessageBusTest\Unit\TestDouble\TestObject;
use PHPUnit\Framework\TestCase;

final class SerializedMessageBuilderTest extends TestCase
{

    public function testSerializedMessageBuilder()
    {
        $serializer = new MessageSerializer();
        $messageBuilder = new SerializedMessageBuilder($serializer);
        $object = new TestObject();
        $expected = $serializer->serialize($object);

        $message = $messageBuilder->build($object);

        $this->assertSame($expected, $message->body());
    }
}
