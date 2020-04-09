<?php

declare(strict_types=1);

namespace MessageBusTest\Unit\Middleware\Queue;

use ArrayIterator;
use MessageBus\Middleware\Queue\ClassNames;
use PHPUnit\Framework\TestCase;

use function get_class;

final class ClassNamesTest extends TestCase
{
    public function testInvokeReturnsTrueForConfiguredClassName(): void
    {
        $mock = $this->createMock(ArrayIterator::class);

        $this->assertTrue((new ClassNames(get_class($mock)))($mock));
    }
}
