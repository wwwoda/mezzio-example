<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Error;

use Woda\MezzioModule\Config\MezzioModuleConfig;

final class ConfigProvider
{
    public function __invoke()
    {
        return MezzioModuleConfig::forModule('error')
            ->withTemplatePath(__DIR__ . '/../templates/')
            ->toArray();
    }
}
