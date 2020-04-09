<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Config;

use Woda\MezzioModule\Config\Exception\UnknownKeyException;

final class NestedArrayConfig implements Config
{
    public const DELIMITER = '/';
    /** @var array */
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function string(string $key): string
    {
        return $this->get($key);
    }

    /**
     * @return mixed
     * @throws UnknownKeyException
     */
    private function get(string $key)
    {
        $paths = explode(self::DELIMITER, $key);
        $current = $this->config;
        foreach ($paths as $index) {
            if (!isset($current[$index])) {
                throw UnknownKeyException::fromKey($key);
            }
            $current = $current[$index];
        }
        return $current;
    }

    public function int(string $key): int
    {
        return $this->get($key);
    }

    public function float(string $key): float
    {
        return $this->get($key);
    }

    public function bool(string $key): bool
    {
        return $this->get($key);
    }

    public function array(string $key): array
    {
        return $this->get($key);
    }
}
