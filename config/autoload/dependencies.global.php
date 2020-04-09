<?php

declare(strict_types=1);

use Laminas\Di\InjectorInterface;
use Woda\MezzioModule\Core\InjectorDecoratorFactory;

/**
 * @param array<string, string> $factories
 * @return array<string, string>
 */
$factories = function (array $factories): array {
    if (!file_exists(__DIR__ . '/../../data/cache/di/factories.php')) {
        return $factories;
    }
    $generatedFactories = include __DIR__ . '/../../data/cache/di/factories.php';
    return \array_merge($generatedFactories, $factories);
};

return [
    'dependencies' => [
        'aliases' => [],
        'invokables' => [],
        'factories' => $factories([]),
        'delegators' => [
            InjectorInterface::class => [
                InjectorDecoratorFactory::class,
            ],
        ],
        'auto' => [
            'aot' => [
                'namespace' => 'AotGeneratedDi',
                'directory' => __DIR__ . '/../gen',
            ],
        ],
    ],
];
