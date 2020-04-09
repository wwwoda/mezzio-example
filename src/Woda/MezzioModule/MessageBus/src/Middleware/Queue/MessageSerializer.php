<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\Middleware\Queue;

use ReflectionClass;
use ReflectionObject;

use function get_class;

final class MessageSerializer
{
    private const TYPE_KEY = 'EventjetCommandType';

    /**
     * @param mixed $message
     */
    public function serialize($message): string
    {
        $data = [];
        $reflectionObject = new ReflectionObject($message);
        foreach ($reflectionObject->getProperties() as $property) {
            $property->setAccessible(true);
            $data[$property->getName()] = $property->getValue($message);
            $property->setAccessible(false);
        }
        $data[self::TYPE_KEY] = get_class($message);
        return json_encode($data);
    }

    /**
     * @return mixed
     */
    public function deserialize(string $serialized)
    {
        $commandData = json_decode($serialized, true);
        $commandClass = new ReflectionClass($commandData[self::TYPE_KEY]);
        $command = $commandClass->newInstanceWithoutConstructor();
        $reflectionObject = new ReflectionObject($command);
        foreach ($commandData as $key => $value) {
            if (!$reflectionObject->hasProperty($key)) {
                continue;
            }
            $reflectionProperty = $reflectionObject->getProperty($key);
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($command, $value);
            $reflectionProperty->setAccessible(false);
        }
        return $command;
    }
}
