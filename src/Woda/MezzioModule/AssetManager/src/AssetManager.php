<?php

namespace Woda\MezzioModule\AssetManager\Service;

use Laminas\Stdlib\RequestInterface;

interface AssetManager
{
    public function resolvesToAsset(RequestInterface $request): bool;

    public function setAssetOnResponse(RequestInterface $request): void;
}
