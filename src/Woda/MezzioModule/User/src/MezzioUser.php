<?php

declare(strict_types=1);

namespace Woda\MezzioModule\User;

use Mezzio\Authentication\UserInterface;
use Woda\User\User;

final class MezzioUser implements UserInterface
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @inheritDoc
     */
    public function getIdentity(): string
    {
        return $this->user->getEmail()->toString();
    }

    /**
     * @inheritDoc
     */
    public function getRoles(): iterable
    {
        return ['user'];
    }

    /**
     * @inheritDoc
     */
    public function getDetail(string $name, $default = null)
    {
        return $default;
    }

    /**
     * @inheritDoc
     */
    public function getDetails(): array
    {
        return [];
    }
}
