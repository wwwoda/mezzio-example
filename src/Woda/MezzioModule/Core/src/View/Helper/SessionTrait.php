<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Core\View\Helper;

use function session_status;

use const PHP_SESSION_ACTIVE;

trait SessionTrait
{
    private function getSession(): array
    {
        return session_status() === PHP_SESSION_ACTIVE
            ? $_SESSION
            : [];
    }
}
