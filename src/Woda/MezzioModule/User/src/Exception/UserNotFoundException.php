<?php

declare(strict_types=1);

namespace Woda\MezzioModule\User\Exception;

use RuntimeException;

class UserNotFoundException extends RuntimeException
{
    public static function fromId(string $id): self
    {
        return new self(\Safe\sprintf('User with id `%s` not found', $id));
    }
}
