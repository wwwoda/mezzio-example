<?php

declare(strict_types=1);

namespace Woda\MezzioModule\I18n\Language;

use InvalidArgumentException;

use function assert;

final class LanguagePriority
{
    /** @var array<int, Language> */
    private $languages;

    public function __construct(Language ...$languages)
    {
        if (count($languages) === 0) {
            throw new InvalidArgumentException('Language priorities need at least one language.');
        }
        $this->languages = $languages;
    }

    /**
     * @return Language[]
     */
    public function getAll(): array
    {
        return $this->languages;
    }

    public function current(): Language
    {
        return current($this->languages);
    }

    public function next(): void
    {
        next($this->languages);
    }

    public function key(): int
    {
        $key = key($this->languages);
        assert($key !== null);
        return $key;
    }

    public function valid(): bool
    {
        $key = key($this->languages);
        return ($key !== null && $key !== false);
    }

    public function rewind(): void
    {
        reset($this->languages);
    }

    /**
     * @return Language
     */
    public function primary()
    {
        $primary = reset($this->languages);
        assert($primary !== false);
        return $primary;
    }
}
