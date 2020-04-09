<?php

declare(strict_types=1);

namespace Woda\User\Command;

use Woda\User\Repository\UserRepository;
use Woda\User\User;

final class RegisterUserHandler
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(RegisterUser $command)
    {
        $this->userRepository->save(new User($command->email(), $command->passwordHash()));
    }
}
