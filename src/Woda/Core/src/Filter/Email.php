<?php

declare(strict_types=1);

namespace Woda\Core\Filter;

use function filter_var;

final class Email
{
    public static function isValid(string $email)
    {
        return $email === filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
