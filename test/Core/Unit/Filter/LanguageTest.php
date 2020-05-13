<?php

declare(strict_types=1);

namespace WodaTest\Core\Unit\Filter;

use PHPUnit\Framework\TestCase;
use Woda\Core\Filter\Language;

class LanguageTest extends TestCase
{
    /**
     * @dataProvider provideLanguages
     */
    public function testLanguageIsValid(string $email, bool $expected): void
    {
        self::assertSame($expected, Language::isValid($email));
    }

    /**
     * @return iterable<string, array{0: string, 1: bool}>
     */
    public function provideLanguages(): iterable
    {
        yield 'Valid language' => ['de', true];
        yield 'Valid language with region' => ['de-AT', true];
        yield 'Invalid language with too many chars' => ['dee', false];
        yield 'Invalid language with not enough chars' => ['d', false];
        yield 'Invalid language with uppercase chars' => ['DE', false];
        yield 'Invalid language with number' => ['d1', false];
        yield 'Invalid language with too many chars in region' => ['de-ATT', false];
        yield 'Invalid language with not enough chars in region' => ['de-A', false];
        yield 'Invalid language with lowercase chars in region' => ['de-at', false];
        yield 'Invalid language with number in region' => ['de-A1', false];
    }
}
