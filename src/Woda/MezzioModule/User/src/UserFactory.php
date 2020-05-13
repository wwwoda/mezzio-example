<?php

declare(strict_types=1);

namespace Woda\MezzioModule\User;

use Mezzio\Authentication\UserInterface;
use Psr\Container\ContainerInterface;
use RuntimeException;
use Woda\Core\ValueObject\Email;
use Woda\User\Repository\UserRepositoryInterface;

final class UserFactory
{
    public function __invoke(ContainerInterface $container): callable
    {
        $userRepository = $container->get(UserRepositoryInterface::class);
        return function (string $identity) use ($userRepository): UserInterface {
            $user = $userRepository->findByEmail(Email::fromString($identity));
            if ($user === null) {
                throw new RuntimeException('User not found');
            }
            return new MezzioUser($user);
        };
    }
}
