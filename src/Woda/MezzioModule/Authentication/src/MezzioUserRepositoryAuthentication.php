<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Authentication;

use Mezzio\Authentication\UserInterface;
use Mezzio\Authentication\UserRepositoryInterface;
use Woda\MezzioModule\User\MezzioUser;

final class MezzioUserRepositoryAuthentication implements UserRepositoryInterface
{
    /** @var CredentialAuthenticationInterface */
    private $repository;

    public function __construct(CredentialAuthenticationInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function authenticate(string $credential, string $password = null): ?UserInterface
    {
        $user = $this->repository->authenticate($credential, $password);
        if ($user === null) {
            return $user;
        }
        return new MezzioUser($user);
    }
}
