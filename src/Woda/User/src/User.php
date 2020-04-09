<?php

declare(strict_types=1);

namespace Woda\User;

use Ramsey\Uuid\Uuid;
use Woda\Core\ValueObject\Email;
use Woda\Core\ValueObject\PasswordHash;

final class User
{
    private string $id;
    private Email $email;
    private PasswordHash $passwordHash;

    public function __construct(Email $email, PasswordHash $passwordHash)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->passwordHash = $passwordHash;
        $this->email = $email;
    }

    public function getPasswordHash(): PasswordHash
    {
        return $this->passwordHash;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getId()
    {
        return $this->id;
    }
}
