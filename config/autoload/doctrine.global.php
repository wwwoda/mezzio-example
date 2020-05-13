<?php

return [
    'doctrine' => [
        'configuration' => [
            'orm_default' => ['proxy_dir' => __DIR__ . '/../../data/cache/doctrine/proxy/orm'],
            'odm_default' => ['proxy_dir' => __DIR__ . '/../../data/cache/doctrine/proxy/odm'],
        ],
        /* @see config/cli-config.php */
        'migrations' => [
            'namespace' => 'Woda\Migrations',
            'directory' => __DIR__ . '/../../data/doctrine/migrations/orm',
        ],
    ],
];
