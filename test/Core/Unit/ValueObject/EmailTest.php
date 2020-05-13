<?php

declare(strict_types=1);

namespace WodaTest\Core\Unit\ValueObject;

use PHPUnit\Framework\TestCase;
use RuntimeException;
use Woda\Core\ValueObject\Email;

class EmailTest extends TestCase
{
    public function testInvalidEmailThrowsException(): void
    {
        $this->expectException(RuntimeException::class);

        Email::fromString('foo');
    }

    public function testToStringReturnsExpectedEmail(): void
    {
        $expected = 'test@example.com';

        self::assertSame($expected, Email::fromString($expected)->toString());
    }

    public function testEqualsReturnsTrue(): void
    {
        $email = 'test@example.com';

        self::assertTrue(Email::fromString($email)->equals(Email::fromString($email)));
    }

    public function testEqualsReturnsFalse(): void
    {
        $email = 'test@example.com';

        self::assertFalse(Email::fromString($email)->equals(Email::fromString('foo@bar.com')));
    }
}
