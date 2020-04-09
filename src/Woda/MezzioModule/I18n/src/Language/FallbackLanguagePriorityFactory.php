<?php

declare(strict_types=1);

namespace Woda\MezzioModule\I18n\Language;

use Psr\Http\Message\ServerRequestInterface;

class FallbackLanguagePriorityFactory implements LanguagePriorityFactoryInterface
{
    /** @var string */
    private $fallback;

    public function __construct(string $fallback = 'de')
    {
        $this->fallback = $fallback;
    }

    public function fromRequest(ServerRequestInterface $request): ?LanguagePriority
    {
        return new LanguagePriority(Language::get($this->fallback));
    }
}
