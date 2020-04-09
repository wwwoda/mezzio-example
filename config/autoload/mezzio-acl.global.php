<?php

declare(strict_types=1);

return [
    'mezzio-authorization-acl' => [
        'roles' => [
            'user'        => [],
            'contributor'   => ['editor'],
            'administrator' => ['contributor'],
        ],
        'resources' => [
            'admin.dashboard',
            'backend.dashboard',
            'backend.api',
        ],
        'allow' => [
            'administrator' => ['backend.dashboard'],
            'contributor' => [
                'backend.dashboard',
                'backend.api',
            ],
            'user' => [
            ],
        ],
    ],
];
