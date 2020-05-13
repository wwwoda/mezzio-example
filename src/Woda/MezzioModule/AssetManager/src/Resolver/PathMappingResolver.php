<?php

declare(strict_types=1);

namespace Woda\MezzioModule\AssetManager\Resolver;

use Woda\MezzioModule\AssetManager\Asset\Asset;
use Woda\MezzioModule\AssetManager\Asset\AssetFactory;

final class PathMappingResolver implements Resolver
{
    /** @var array<string, string> */
    private array $pathMapping;
    private AssetFactory $factory;

    public function __construct(array $pathMapping, AssetFactory $factory)
    {
        $this->pathMapping = $pathMapping;
        $this->factory = $factory;
    }

    public function resolve(string $path): ?Asset
    {
        if ($path === '/') {
            return null;
        }
        foreach ($this->pathMapping as $current) {
            $fullPath = $current . $path;
            if (!file_exists($fullPath)) {
                continue;
            }
            return $this->factory->create($fullPath);
        }
        return null;
    }
}
