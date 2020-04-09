<?php

declare(strict_types=1);

namespace MessageBusTest\Unit\Middleware\Queue;

use MessageBus\Middleware\Queue\MessageSerializer;
use MessageBusTest\Unit\TestDouble\TestObject;
use PHPUnit\Framework\TestCase;

use function get_class;

final class MessageSerializerTest extends TestCase
{
    /** @var MessageSerializer */
    private $serializer;

    public function testSerialize(): void
    {
        $object = new TestObject();
        $object->testProperty = 'test';

        $json = $this->serializer->serialize($object);

        $array = json_decode($json, true);
        $this->assertArrayHasKey('EventjetCommandType', $array);
        $this->assertArrayHasKey('testProperty', $array);
        $this->assertSame(get_class($object), $array['EventjetCommandType']);
        $this->assertSame('test', $array['testProperty']);
    }

    public function testDeserialize(): void
    {
        $expected = new TestObject();
        $expected->testProperty = 'test';

        $object = $this->serializer->deserialize(
            '{"testProperty":"test","EventjetCommandType":"MessageBusTest\\\\Unit\\\\TestDouble\\\\TestObject"}'
        );

        $this->assertEquals($expected, $object);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->serializer = new MessageSerializer();
    }
}
