<?php

declare(strict_types=1);

namespace Woda\MezzioModule\AssetManager\Asset;

use Assetic\Asset\AssetInterface;

final class AsseticAsset implements Asset
{
    private AssetInterface $asset;

    public function __construct(AssetInterface $asset)
    {
        $this->asset = $asset;
    }

    public function getPath(): string
    {
        return $this->asset->getSourceDirectory() . '/' . $this->asset->getSourcePath();
    }

    public function getMimeType(): string
    {
        $mimeType = \Safe\mime_content_type($this->getPath());
        if ($mimeType !== 'text/plain') {
            return $mimeType;
        }
        ['extension' => $extension] = pathinfo($this->getPath());
        if ($extension === 'css') {
            return 'text/css';
        }
        if ($extension === 'js') {
            return 'text/javascript';
        }
        return $mimeType;
    }

    public function getContent(): string
    {
        return $this->asset->dump();
    }

    public function getContentLength(): int
    {
        if (!function_exists('mb_strlen')) {
            return strlen($this->getContent());
        }
        return mb_strlen($this->getContent(), '8bit');
    }
}
