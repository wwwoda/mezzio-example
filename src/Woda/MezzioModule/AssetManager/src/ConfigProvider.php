<?php

declare(strict_types=1);

namespace Woda\MezzioModule\AssetManager;

use Woda\MezzioModule\AssetManager\Middleware\ResolveAssetMiddleware;
use Woda\MezzioModule\AssetManager\Middleware\ResolveAssetMiddlewareFactory;
use Woda\MezzioModule\Config\MezzioModuleConfig;

final class ConfigProvider
{
    public function __invoke()
    {
        return MezzioModuleConfig::forModule('asset-manager')
            ->withConfig(
                [
                    'dependencies' => [
                        'factories' => [
                            ResolveAssetMiddleware::class => ResolveAssetMiddlewareFactory::class,
                        ],
                    ],
                ]
            )
            ->toArray();
    }
}
