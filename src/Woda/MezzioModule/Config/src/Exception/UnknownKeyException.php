<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Config\Exception;

use RuntimeException;

class UnknownKeyException extends RuntimeException
{
    public static function fromKey(string $key): self
    {
        throw new self(\Safe\sprintf('Unknown config key "%s".', $key));
    }
}
