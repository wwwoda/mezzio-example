<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Core\Resolver;

interface Resolver
{
    public function resolve(string $path): ?Asset;
}
