<?php

declare(strict_types=1);

namespace Woda\User\Command;

use Woda\User\Repository\UserRepositoryInterface;
use Woda\User\User;

final class RegisterUserHandler
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(RegisterUser $command)
    {
        $this->userRepository->save(new User($command->email(), $command->passwordHash()));
    }
}
