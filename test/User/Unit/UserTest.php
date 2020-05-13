<?php declare(strict_types=1);

namespace WodaTest\User\Unit;

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Woda\Core\ValueObject\Email;
use Woda\Core\ValueObject\PasswordHash;
use Woda\User\User;

class UserTest extends TestCase
{
    public function testGetEmailReturnsExpectedEmail(): void
    {
        $expected = Email::fromString('test@example.com');

        $user = new User($expected, PasswordHash::fromString('foo'));

        self::assertTrue($expected->equals($user->getEmail()));
    }

    public function testGetPasswordHashReturnsExpectedHash(): void
    {
        $expected = PasswordHash::fromString('foo');

        $user = new User(Email::fromString('test@example.com'), $expected);

        self::assertSame($expected->toString(), $user->getPasswordHash()->toString());
    }

    public function testGetIdReturnsValidUuid(): void
    {
        $user = new User(Email::fromString('test@example.com'), PasswordHash::fromString('foo'));

        self::assertTrue(Uuid::isValid($user->getId()));
    }
}
