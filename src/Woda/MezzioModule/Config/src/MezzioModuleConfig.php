<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Config;

use Laminas\ConfigAggregator\ArrayProvider;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;

final class MezzioModuleConfig
{
    /** @var string */
    private $name;
    /** @var callable[] */
    private $configProvider = [];

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function forModule(string $name): self
    {
        return new self($name);
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return (new ConfigAggregator($this->configProvider))->getMergedConfig();
    }

    public function withTemplatePath(string $templatePath): self
    {
        return $this->addedConfigProvider(
            new ArrayProvider(['templates' => ['paths' => [$this->name => $templatePath . $this->name]]])
        );
    }

    private function addedConfigProvider(callable $provider): self
    {
        $clone = clone $this;
        $clone->configProvider[] = $provider;
        return $clone;
    }

    public function withAssetPath(string $assetPath): self
    {
        return $this->addedConfigProvider(new ArrayProvider(['asset_manager' => ['paths' => [$assetPath]]]));
    }

    public function withConfigFolder(string $configFolderPath): self
    {
        return $this->addedConfigProvider(new PhpFileProvider($configFolderPath . '/{{,*.}config}.php'));
    }

    public function withRouteProvider(string $class)
    {
        return $this->addedConfigProvider(new ArrayProvider(['woda' => ['route_provider' => [$class]]]));
    }

    public function withConfig(array $config): self
    {
        return $this->addedConfigProvider(new ArrayProvider($config));
    }

    public function withCommandBusMapping(string $class): self
    {
        return $this->addedConfigProvider(new ArrayProvider(['command_bus' => ['mapping_provider' => [$class]]]));
    }

    public function withEventBusMapping(string $class): self
    {
        return $this->addedConfigProvider(new ArrayProvider(['event_bus' => ['mapping_provider' => [$class]]]));
    }
}
