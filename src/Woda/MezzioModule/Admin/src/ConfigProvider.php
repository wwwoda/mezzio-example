<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Admin;

use Woda\MezzioModule\Config\MezzioModuleConfig;

final class ConfigProvider
{
    public function __invoke()
    {
        return MezzioModuleConfig::forModule('admin')
            ->withTemplatePath(__DIR__ . '/../template/')
            ->withRouteProvider(AdminRouter::class)
            ->withPipeProvider(AdminRouter::class)
            ->toArray();
    }
}
