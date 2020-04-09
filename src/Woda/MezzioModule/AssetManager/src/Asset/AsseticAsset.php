<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Core\Resolver;

use Assetic\Asset\AssetInterface;
use Assetic\Filter\FilterInterface;

final class AsseticAsset implements AssetInterface
{
    /** @var Asset */
    private $asset;

    public function __construct(Asset $asset)
    {
        $this->asset = $asset;
    }

    /**
     * @inheritDoc
     */
    public function ensureFilter(FilterInterface $filter)
    {
        // TODO: Implement ensureFilter() method.
    }

    /**
     * @inheritDoc
     */
    public function getFilters()
    {
        // TODO: Implement getFilters() method.
    }

    /**
     * @inheritDoc
     */
    public function clearFilters()
    {
        // TODO: Implement clearFilters() method.
    }

    /**
     * @inheritDoc
     */
    public function load(FilterInterface $additionalFilter = null)
    {
        // TODO: Implement load() method.
    }

    /**
     * @inheritDoc
     */
    public function dump(FilterInterface $additionalFilter = null)
    {
        // TODO: Implement dump() method.
    }

    /**
     * @inheritDoc
     */
    public function getContent()
    {
        // TODO: Implement getContent() method.
    }

    /**
     * @inheritDoc
     */
    public function setContent($content)
    {
        // TODO: Implement setContent() method.
    }

    /**
     * @inheritDoc
     */
    public function getSourceRoot()
    {
        // TODO: Implement getSourceRoot() method.
    }

    /**
     * @inheritDoc
     */
    public function getSourcePath()
    {
        // TODO: Implement getSourcePath() method.
    }

    /**
     * @inheritDoc
     */
    public function getSourceDirectory()
    {
        // TODO: Implement getSourceDirectory() method.
    }

    /**
     * @inheritDoc
     */
    public function getTargetPath()
    {
        // TODO: Implement getTargetPath() method.
    }

    /**
     * @inheritDoc
     */
    public function setTargetPath($targetPath)
    {
        // TODO: Implement setTargetPath() method.
    }

    /**
     * @inheritDoc
     */
    public function getLastModified()
    {
        // TODO: Implement getLastModified() method.
    }

    /**
     * @inheritDoc
     */
    public function getVars()
    {
        // TODO: Implement getVars() method.
    }

    /**
     * @inheritDoc
     */
    public function setValues(array $values)
    {
        // TODO: Implement setValues() method.
    }

    /**
     * @inheritDoc
     */
    public function getValues()
    {
        // TODO: Implement getValues() method.
    }
}
