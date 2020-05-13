<?php

declare(strict_types=1);

namespace WodaTest\Core\Unit\DateTime;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Woda\Core\DateTime\StaticClock;

class StaticClockTest extends TestCase
{
    public function testReturnsExpectedDateTime()
    {
        $expected = new DateTimeImmutable();

        self::assertSame($expected, (new StaticClock($expected))->read());
    }
}
