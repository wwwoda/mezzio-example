<?php

declare(strict_types=1);

namespace Woda\MezzioModule\I18n\Language;

use Psr\Http\Message\ServerRequestInterface;

class CookieLanguagePriorityFactory implements LanguagePriorityFactoryInterface
{
    public function fromRequest(ServerRequestInterface $request): ?LanguagePriority
    {
        $cookie = $request->getCookieParams();
        if (!isset($cookie['locale'])) {
            return null;
        }
        return new LanguagePriority([Language::get($cookie['locale'])]);
    }
}
