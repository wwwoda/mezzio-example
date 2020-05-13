<?php

declare(strict_types=1);

namespace WodaTest\Core\Unit\DateTime;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Woda\Core\DateTime\SystemClock;

class SystemClockTest extends TestCase
{
    public function testReturnsExpectedTimestamp()
    {
        self::assertSame((new DateTimeImmutable())->getTimestamp(), (new SystemClock())->read()->getTimestamp());
    }
}
