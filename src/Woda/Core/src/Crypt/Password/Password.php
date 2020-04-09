<?php

declare(strict_types=1);

namespace Woda\Core\Crypt\Password;

use Woda\Core\ValueObject\PasswordHash;

interface Password
{
    public function create(string $password): PasswordHash;
    public function verify(string $password, PasswordHash $hash): bool;
}
