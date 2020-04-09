<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Core;

use Woda\MezzioModule\Authentication\Middleware\AuthenticationMiddleware;
use Woda\MezzioModule\Core\Middleware\CsrfMiddleware;
use Woda\MezzioModule\Core\Middleware\FlashMessageMiddleware;
use Woda\MezzioModule\Core\Middleware\PrgMiddleware;
use Woda\MezzioModule\Core\Middleware\SessionMiddleware;
use Woda\MezzioModule\I18n\Middleware\LanguagePriorityMiddleware;
use Woda\MezzioModule\User\Middleware\AuthorizationMiddleware;

/**
 * @return array<string>
 */
function adminMiddleware(string $handler): array
{
    return [
        AuthenticationMiddleware::class,
        AuthorizationMiddleware::class,
        $handler,
    ];
}

/**
 * @return array<string>
 */
function apiMiddleware(string $handler): array
{
    return [
        $handler,
    ];
}

/**
 * @return array<string>
 */
function backendMiddleware(string $handler): array
{
    return [
        AuthenticationMiddleware::class,
        AuthorizationMiddleware::class,
        $handler,
    ];
}

/**
 * @return array<string>
 */
function formMiddleware(string $handler): array
{
    return [
        LanguagePriorityMiddleware::class,
        SessionMiddleware::class,
        FlashMessageMiddleware::class,
        CsrfMiddleware::class,
        PrgMiddleware::class,
        $handler,
    ];
}

/**
 * @return array<string>
 */
function userMiddleware(string $handler): array
{
    return [
        $handler,
    ];
}
