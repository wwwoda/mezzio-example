<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Authentication;

use Mezzio\Authentication\AuthenticationInterface;
use Mezzio\Authentication\Session\PhpSession;
use Mezzio\Authentication\UserRepositoryInterface;

final class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'authentication' => [
                'redirect' => '/',
                'username' => 'email',
                'password' => 'password',
            ],
            'dependencies' => [
                'aliases' => [
                    AuthenticationInterface::class => PhpSession::class,
                    CredentialAuthenticationInterface::class => UserRepositoryCredentialAuthentication::class,
                    UserRepositoryInterface::class => MezzioUserRepositoryAuthentication::class,
                ],
            ],
        ];
    }
}
