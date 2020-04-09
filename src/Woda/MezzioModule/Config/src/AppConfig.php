<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Config;

use Psr\Container\ContainerInterface;

final class AppConfig implements Config
{
    /** @var Config */
    private $config;

    private function __construct(Config $config)
    {
        $this->config = $config;
    }

    public static function fromContainer(ContainerInterface $container): self
    {
        return new self($container->get(Config::class));
    }

    public function string(string $key): string
    {
        return $this->config->string($key);
    }

    public function int(string $key): int
    {
        return $this->config->int($key);
    }

    public function float(string $key): float
    {
        return $this->config->float($key);
    }

    public function bool(string $key): bool
    {
        return $this->config->bool($key);
    }

    public function array(string $key): array
    {
        return $this->config->array($key);
    }
}
