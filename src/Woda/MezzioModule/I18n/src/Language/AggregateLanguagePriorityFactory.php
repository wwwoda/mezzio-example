<?php

declare(strict_types=1);

namespace Woda\MezzioModule\I18n\Language;

use Psr\Http\Message\ServerRequestInterface;

class AggregateLanguagePriorityFactory implements LanguagePriorityFactoryInterface
{
    /** @var LanguagePriorityFactoryInterface[]|iterable */
    private $factories;

    public function __construct(iterable $factories)
    {
        $this->factories = $factories;
    }

    public function fromRequest(ServerRequestInterface $request): ?LanguagePriority
    {
        /** @var LanguagePriority|null $languages */
        $languages = null;
        foreach ($this->factories as $factory) {
            $factoryLanguages = $factory->fromRequest($request);
            if ($factoryLanguages === null) {
                continue;
            }
            if ($languages === null) {
                $languages = $factoryLanguages;
                continue;
            }
            $languages = new LanguagePriority(array_merge($languages->getAll(), $factoryLanguages->getAll()));
        }
        return $languages;
    }
}
