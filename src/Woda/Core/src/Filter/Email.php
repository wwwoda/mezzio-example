<?php

declare(strict_types=1);

namespace Woda\Core\Filter;

final class Email
{
    public static function isValid(string $email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
