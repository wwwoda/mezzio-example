<?php

declare(strict_types=1);

namespace WodaTest\Core\Unit\Filter;

use PHPUnit\Framework\TestCase;
use Woda\Core\Filter\Email;

class EmailTest extends TestCase
{
    /**
     * @dataProvider provideEmails
     */
    public function testEmailIsValid(string $email, bool $expected): void
    {
        self::assertSame($expected, Email::isValid($email));
    }

    /**
     * @return iterable<string, array{0: string, 1: bool}>
     */
    public function provideEmails(): iterable
    {
        yield 'Valid email' => ['test@example.com', true];
        yield 'Invalid email missing @' => ['test(at)example.com', false];
        yield 'Invalid email missing domain ending' => ['test@example', false];
        yield 'Invalid email missing TLD' => ['test', false];
    }
}
