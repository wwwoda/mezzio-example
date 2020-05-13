<?php

declare(strict_types=1);

namespace Woda\MezzioModule\AssetManager;

use Woda\MezzioModule\AssetManager\Asset\AssetFactory;
use Woda\MezzioModule\AssetManager\Asset\AsseticAssetFactory;
use Woda\MezzioModule\AssetManager\Resolver\PathMappingResolver;
use Woda\MezzioModule\AssetManager\Resolver\PathMappingResolverFactory;
use Woda\MezzioModule\AssetManager\Resolver\Resolver;
use Woda\MezzioModule\Config\MezzioModuleConfig;

final class ConfigProvider
{
    public function __invoke()
    {
        return MezzioModuleConfig::forModule('asset-manager')
            ->withConfig(
                [
                    'dependencies' => [
                        'aliases' => [
                            AssetFactory::class => AsseticAssetFactory::class,
                            Resolver::class => PathMappingResolver::class,
                        ],
                        'factories' => [
                            PathMappingResolver::class => PathMappingResolverFactory::class,
                        ],
                    ],
                ]
            )
            ->toArray();
    }
}
