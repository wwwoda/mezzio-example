<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Config;

final class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => [
                'aliases' => [
                    Config::class => NestedArrayConfig::class,
                ],
                'factories' => [
                    NestedArrayConfig::class => NestedArrayConfigFactory::class,
                ],
            ],
        ];
    }
}
