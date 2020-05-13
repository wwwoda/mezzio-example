<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Authentication;

use Woda\Core\Crypt\Password\PasswordInterface;
use Woda\Core\ValueObject\Email;
use Woda\User\Repository\UserRepositoryInterface;
use Woda\User\User;

final class UserRepositoryCredentialAuthentication implements CredentialAuthenticationInterface
{
    private UserRepositoryInterface $repository;
    private PasswordInterface $password;

    public function __construct(UserRepositoryInterface $repository, PasswordInterface $password)
    {
        $this->repository = $repository;
        $this->password = $password;
    }

    /**
     * @inheritDoc
     */
    public function authenticate(string $credential, string $password = null): ?User
    {
        if ($password === null) {
            return null;
        }
        $user = $this->repository->findByEmail(Email::fromString($credential));
        if ($user === null) {
            return null;
        }
        if (!$this->password->verify($password, $user->getPasswordHash())) {
            return null;
        }
        return $user;
    }
}
