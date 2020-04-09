<?php

declare(strict_types=1);

namespace Woda\User\Command;

use Woda\Core\ValueObject\Email;
use Woda\Core\ValueObject\PasswordHash;

final class RegisterUser
{
    private string $email;
    private string $hash;

    public function __construct(Email $email, PasswordHash $hash)
    {
        $this->email = $email->toString();
        $this->hash = $hash->toString();
    }

    public function email(): Email
    {
        return Email::fromString($this->email);
    }

    public function passwordHash(): PasswordHash
    {
        return PasswordHash::fromString($this->hash);
    }
}
