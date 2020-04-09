<?php

declare(strict_types=1);

namespace Woda\MezzioModule\I18n\Language;

use Psr\Http\Message\ServerRequestInterface;

interface LanguagePriorityFactoryInterface
{
    public function fromRequest(ServerRequestInterface $request): ?LanguagePriority;
}
