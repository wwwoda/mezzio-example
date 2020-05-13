<?php

declare(strict_types=1);

namespace Woda\MezzioModule\AssetManager\Asset;

interface Asset
{
    public function getPath(): string;
    public function getMimeType(): string;
    public function getContentLength(): int;
    public function getContent(): string;
}
