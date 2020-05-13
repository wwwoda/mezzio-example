<?php

declare(strict_types=1);

namespace Woda\Core\ValueObject;

final class PasswordHash
{
    private string $hash;

    private function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    public static function fromString(string $hash): self
    {
        return new self($hash);
    }

    public function toString(): string
    {
        return $this->hash;
    }
}
