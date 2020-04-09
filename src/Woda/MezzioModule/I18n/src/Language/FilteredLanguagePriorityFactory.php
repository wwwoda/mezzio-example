<?php

declare(strict_types=1);

namespace Woda\MezzioModule\I18n\Language;

use Psr\Http\Message\ServerRequestInterface;

use function in_array;

class FilteredLanguagePriorityFactory implements LanguagePriorityFactoryInterface
{
    /** @var LanguagePriorityFactoryInterface */
    private $priorityFactory;

    /** @var array */
    private $whitelist;

    public function __construct(LanguagePriorityFactoryInterface $priorityFactory, array $whitelist)
    {
        $this->priorityFactory = $priorityFactory;
        $this->whitelist = $whitelist;
    }

    public function fromRequest(ServerRequestInterface $request): ?LanguagePriority
    {
        $languages = $this->priorityFactory->fromRequest($request);
        if ($languages === null) {
            return null;
        }

        $filteredLanguages = array_filter(
            $languages->getAll(),
            function (Language $language) {
                return in_array((string)$language, $this->whitelist, true);
            }
        );

        if (empty($filteredLanguages)) {
            return null;
        }
        return new LanguagePriority(array_values($filteredLanguages));
    }
}
