<?php

declare(strict_types=1);

use Woda\User\Repository\MemoryUserRepository;
use Woda\User\Repository\UserRepositoryInterface;

if (getenv('APP_TESTING_USE_DATABASE')) {
    return [];
}

return [
    'dependencies' => [
        'aliases' => [
            UserRepositoryInterface::class => MemoryUserRepository::class
        ],
    ],
];
