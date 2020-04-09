<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Config;

interface Config
{
    public function string(string $key): string;

    public function int(string $key): int;

    public function float(string $key): float;

    public function bool(string $key): bool;

    public function array(string $key): array;
}
