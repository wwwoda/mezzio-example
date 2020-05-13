<?php

declare(strict_types=1);

namespace Woda\MezzioModule\AssetManager\Resolver;

use Psr\Container\ContainerInterface;
use Woda\MezzioModule\AssetManager\Asset\AssetFactory;
use Woda\MezzioModule\Config\AppConfig;

final class PathMappingResolverFactory
{
    public function __invoke(ContainerInterface $container): PathMappingResolver
    {
        return new PathMappingResolver(
            AppConfig::fromContainer($container)->array('asset_manager/paths'),
            $container->get(AssetFactory::class)
        );
    }
}
