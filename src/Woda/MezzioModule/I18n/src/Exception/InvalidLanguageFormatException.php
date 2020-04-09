<?php

declare(strict_types=1);

namespace Woda\MezzioModule\I18n\Exception;

use UnexpectedValueException;

class InvalidLanguageFormatException extends UnexpectedValueException
{
    public static function fromLanguage(string $language)
    {
        return new self(\Safe\sprintf('Invalid language "%s".', $language));
    }
}
