<?php

declare(strict_types=1);

namespace Woda\User\Repository;

use Woda\Core\ValueObject\Email;
use Woda\User\User;

interface UserRepositoryInterface
{
    public function findById(string $id): User;
    public function save(User $user): void;
    public function findByEmail(Email $email): ?User;
}
