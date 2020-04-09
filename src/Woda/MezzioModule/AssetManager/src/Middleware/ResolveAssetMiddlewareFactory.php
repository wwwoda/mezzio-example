<?php

declare(strict_types=1);

namespace Woda\MezzioModule\AssetManager\Middleware;

use Laminas\View\Helper\BasePath;
use Psr\Container\ContainerInterface;
use Woda\MezzioModule\Config\AppConfig;

final class ResolveAssetMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): ResolveAssetMiddleware
    {
        return new ResolveAssetMiddleware(
            $container->get(BasePath::class),
            AppConfig::fromContainer($container)->array('asset_manager/paths')
        );
    }
}
