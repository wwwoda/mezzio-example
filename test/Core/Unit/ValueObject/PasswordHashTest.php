<?php

declare(strict_types=1);

namespace WodaTest\Core\Unit\ValueObject;

use PHPUnit\Framework\TestCase;
use Woda\Core\ValueObject\PasswordHash;

class PasswordHashTest extends TestCase
{

    public function testToString(): void
    {
        $expected = 'pw-hash';

        self::assertSame($expected, PasswordHash::fromString($expected)->toString());
    }
}
