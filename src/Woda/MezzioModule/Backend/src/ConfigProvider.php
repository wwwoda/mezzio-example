<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Backend;

use Woda\MezzioModule\Config\MezzioModuleConfig;

final class ConfigProvider
{
    public function __invoke()
    {
        return MezzioModuleConfig::forModule('backend')
            ->withTemplatePath(__DIR__ . '/../templates/')
            ->withAssetPath(__DIR__ . '/../assets/')
            ->withRouteProvider(BackendRouter::class)
            ->withPipeProvider(BackendRouter::class)
            ->toArray();
    }
}
