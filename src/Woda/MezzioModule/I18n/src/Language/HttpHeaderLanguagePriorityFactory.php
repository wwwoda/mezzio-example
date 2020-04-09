<?php

declare(strict_types=1);

namespace Woda\MezzioModule\I18n\Language;

use Psr\Http\Message\ServerRequestInterface;
use Woda\MezzioModule\I18n\Exception\InvalidLanguageFormatException;

use function array_filter;
use function array_map;
use function array_merge;
use function array_reduce;
use function explode;
use function preg_replace;
use function str_replace;
use function strlen;
use function strpos;
use function strtolower;
use function trim;
use function usort;

class HttpHeaderLanguagePriorityFactory implements LanguagePriorityFactoryInterface
{
    public function fromRequest(ServerRequestInterface $request): ?LanguagePriority
    {
        $acceptLanguage = $request->getHeader('Accept-Language');
        if (!isset($acceptLanguage[0])) {
            return null;
        }
        $languages = $this->parseAcceptLanguageHeader($acceptLanguage);

        if (empty($languages)) {
            return null;
        }
        return new LanguagePriority($languages);
    }

    /**
     * @return Language[]
     */
    private function parseAcceptLanguageHeader(array $acceptLanguage): iterable
    {
        $languageTuples = $this->makeLanguageTuples($acceptLanguage);
        $languageTuples = $this->normalizeLanguageTuples($languageTuples);
        $languageTuples = $this->sortLanguageTuples($languageTuples);
        $languages = array_map(
            static function ($language) {
                try {
                    return Language::get($language[0]);
                } catch (InvalidLanguageFormatException $exception) {
                    return null;
                }
            },
            $languageTuples
        );
        return array_filter($languages);
    }

    private function makeLanguageTuples(array $acceptLanguage): array
    {
        $languages = str_replace(' ', '', $acceptLanguage[0]);
        $priorityGroups = explode(',', $languages);
        return array_reduce(
            $priorityGroups,
            static function ($languages, $group) {
                $parts = explode(';', $group);
                $level = 1;
                $langs = [];
                foreach ($parts as $part) {
                    if (substr($part, 0, 2) === 'q=') {
                        $level = (float)substr($part, 2);
                    } else {
                        $langs[] = $part;
                    }
                }
                $langs = array_map(
                    function ($language) use ($level) {
                        return [$language, $level];
                    },
                    $langs
                );
                return array_merge($languages, $langs);
            },
            []
        );
    }

    private function normalizeLanguageTuples(array $languageTuples): array
    {
        $returnLanguage = [];
        foreach ($languageTuples as $language) {
            $langString = $this->normalize($language[0]);
            if (!$this->hasValidLength($langString)) {
                continue;
            }
            if (strpos($langString, '-') !== false) {
                $parts = explode('-', $langString);
                $langString = strtolower($parts[0]) . '-' . strtoupper($parts[1]);
            }

            $returnLanguage[] = [0 => $langString, 1 => $language[1]];
        }

        return $returnLanguage;
    }

    private function normalize(string $langString): string
    {
        $langString = trim($langString);
        $langString = preg_replace('/\s/', '', $langString);
        $langString = str_replace('_', '-', $langString);
        $langString = strtolower($langString);

        return $langString;
    }

    private function hasValidLength(string $langString): bool
    {
        return strlen($langString) === 2 || strlen($langString) === 5;
    }

    private function sortLanguageTuples(array $languageTuples): array
    {
        usort(
            $languageTuples,
            static function ($a, $b) {
                if ($a[1] === $b[1]) {
                    return 0;
                }
                return $a[1] < $b[1];
            }
        );
        return $languageTuples;
    }
}
