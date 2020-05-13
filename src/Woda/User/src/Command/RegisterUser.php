<?php

declare(strict_types=1);

namespace Woda\User\Command;

use Woda\Core\ValueObject\Email;
use Woda\Core\ValueObject\PasswordHash;

final class RegisterUser
{
    private string $email;
    private ?string $hash;

    public static function withPasswordHash(Email $email, PasswordHash $hash): self
    {
        $instance = new self($email);
        $instance->hash = $hash->toString();
        return $instance;
    }

    private function __construct(Email $email)
    {
        $this->email = $email->toString();
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
