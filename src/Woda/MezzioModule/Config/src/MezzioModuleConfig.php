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
        return $this->addArrayConfig(['templates' => ['paths' => [$this->name => $templatePath . $this->name]]]);
    }

    public function withAssetPath(string $assetPath): self
    {
        return $this->addArrayConfig(['asset_manager' => ['paths' => [$assetPath]]]);
    }

    public function withConfigFolder(string $configFolderPath): self
    {
        return $this->addConfigProvider(new PhpFileProvider($configFolderPath . '/{{,*.}config}.php'));
    }

    public function withRouteProvider(string $class)
    {
        return $this->addArrayConfig(['woda' => ['router' => ['route_provider' => [$class]]]]);
    }

    public function withPipeProvider(string $class)
    {
        return $this->addArrayConfig(['woda' => ['router' => ['pipe_provider' => [$class]]]]);
    }

    public function withConfig(array $config): self
    {
        return $this->addArrayConfig($config);
    }

    public function withCommandBusMapping(string $class): self
    {
        return $this->addArrayConfig(['command_bus' => ['mapping_provider' => [$class]]]);
    }

    public function withEventBusMapping(string $class): self
    {
        return $this->addArrayConfig(['event_bus' => ['mapping_provider' => [$class]]]);
    }

    private function addArrayConfig(array $array): self
    {
        return $this->addConfigProvider(new ArrayProvider($array));
    }

    private function addConfigProvider(callable $provider): self
    {
        $clone = clone $this;
        $clone->configProvider[] = $provider;
        return $clone;
    }
}
