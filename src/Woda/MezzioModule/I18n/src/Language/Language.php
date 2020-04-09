<?php

declare(strict_types=1);

namespace Woda\MezzioModule\I18n\Language;

use Woda\Core\Filter\Language as LanguageFilter;
use Woda\MezzioModule\I18n\Exception\InvalidLanguageFormatException;

final class Language
{
    /** @var Language[] */
    private static $pool = [];
    /** @var string */
    private $language;

    private function __construct(string $language)
    {
        if (!LanguageFilter::isValid($language)) {
            throw InvalidLanguageFormatException::fromLanguage($language);
        }
        $this->language = $language;
    }

    public static function get(string $language): Language
    {
        if (!isset(self::$pool[$language])) {
            self::$pool[$language] = new self($language);
        }
        return self::$pool[$language];
    }

    public function __toString(): string
    {
        return $this->language;
    }
}
