<?php

declare(strict_types=1);

namespace Woda\MezzioModule\I18n\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Woda\MezzioModule\I18n\Language\LanguagePriority;
use Woda\MezzioModule\I18n\Language\LanguagePriorityFactoryInterface;

final class LanguagePriorityMiddleware implements MiddlewareInterface
{
    private const LANGUAGES = 'languages';
    /** @var LanguagePriorityFactoryInterface */
    private $languagePriorityFactory;

    public function __construct(LanguagePriorityFactoryInterface $languagePriorityFactory)
    {
        $this->languagePriorityFactory = $languagePriorityFactory;
    }

    public static function languages(ServerRequestInterface $request): LanguagePriority
    {
        return $request->getAttribute(self::LANGUAGES);
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $languages = $this->languagePriorityFactory->fromRequest($request);
        $request = $request->withAttribute(self::LANGUAGES, $languages);
        return $handler->handle($request);
    }
}
