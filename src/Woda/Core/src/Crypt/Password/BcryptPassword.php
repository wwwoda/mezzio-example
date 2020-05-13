<?php

declare(strict_types=1);

namespace Woda\Core\Crypt\Password;

use Safe\Exceptions\PasswordException;
use Woda\Core\ValueObject\PasswordHash;

final class BcryptPassword implements PasswordInterface
{
    /**
     * @throws PasswordException
     */
    public function create(string $password): PasswordHash
    {
        return PasswordHash::fromString(\Safe\password_hash($password, PASSWORD_BCRYPT));
    }

    public function verify(string $password, PasswordHash $hash): bool
    {
        return password_verify($password, $hash->toString());
    }
}
