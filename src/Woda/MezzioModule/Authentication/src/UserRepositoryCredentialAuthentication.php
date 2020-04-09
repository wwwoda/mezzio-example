<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Authentication;

use Woda\Core\Crypt\Password\Password;
use Woda\Core\ValueObject\Email;
use Woda\User\Repository\UserRepository;
use Woda\User\User;

final class UserRepositoryCredentialAuthentication implements CredentialAuthenticationInterface
{
    /** @var UserRepository */
    private $repository;
    /** @var Password */
    private $password;

    public function __construct(UserRepository $repository, Password $password)
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
