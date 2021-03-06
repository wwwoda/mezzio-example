<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Core\Crypt\Password;

use Laminas\Crypt\Password\Bcrypt;
use Woda\Core\Crypt\Password\PasswordInterface;
use Woda\Core\ValueObject\PasswordHash;

final class LaminasBcryptPasswordInterface implements PasswordInterface
{
    private Bcrypt $bcrypt;

    public function __construct(Bcrypt $bcrypt)
    {
        $this->bcrypt = $bcrypt;
    }

    public function create(string $password): PasswordHash
    {
        return PasswordHash::fromString($this->bcrypt->create($password));
    }

    public function verify(string $password, PasswordHash $hash): bool
    {
        return $this->bcrypt->verify($password, $hash->toString());
    }
}
