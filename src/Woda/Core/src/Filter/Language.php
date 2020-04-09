<?php

declare(strict_types=1);

namespace Woda\Core\Filter;

final class Language
{
    private const LANGUAGE_FORMAT_REGEXP = '/^([a-z]{2}(-[A-Z]{2})?)$/';

    public static function isValid(string $language)
    {
        return preg_match(self::LANGUAGE_FORMAT_REGEXP, $language) === 1;
    }
}
