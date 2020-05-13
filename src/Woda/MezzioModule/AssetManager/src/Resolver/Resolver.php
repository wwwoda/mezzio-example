<?php

declare(strict_types=1);

namespace Woda\MezzioModule\AssetManager\Resolver;

use Woda\MezzioModule\AssetManager\Asset\Asset;

interface Resolver
{
    public function resolve(string $path): ?Asset;
}
