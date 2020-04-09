<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Core\Resolver;

interface Asset
{
    public function resolve(string $path): ?Asset;
}
