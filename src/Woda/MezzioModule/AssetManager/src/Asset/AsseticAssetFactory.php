<?php

declare(strict_types=1);

namespace Woda\MezzioModule\AssetManager\Asset;

use Assetic\Asset\FileAsset;

final class AsseticAssetFactory implements AssetFactory
{
    public function create(string $path): Asset
    {
        return new AsseticAsset(new FileAsset($path));
    }
}
