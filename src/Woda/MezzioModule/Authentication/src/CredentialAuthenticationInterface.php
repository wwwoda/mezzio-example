<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Authentication;

use Woda\User\User;

interface CredentialAuthenticationInterface
{
    public function authenticate(string $credential, ?string $password = null): ?User;
}
