<?php

declare(strict_types=1);

namespace Woda\MezzioModule\AssetManager\Asset;

interface AssetFactory
{
    public function create(string $path): Asset;
}
