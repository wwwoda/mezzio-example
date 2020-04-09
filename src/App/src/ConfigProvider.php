<?php

declare(strict_types=1);

namespace App;

use Woda\MezzioModule\Config\MezzioModuleConfig;

final class ConfigProvider
{
    public function __invoke(): array
    {
        return MezzioModuleConfig::forModule('app')
            ->withTemplatePath(__DIR__ . '/../templates/')
            ->withRouteProvider(AppRouter::class)
            ->withConfig(
                [
                    'templates' => [
                        'paths' => [
                            'error' => [__DIR__ . '/../templates/error'],
                            'layout' => [__DIR__ . '/../templates/layout'],
                        ]
                    ],
                ]
            )
            ->toArray();
    }
}
