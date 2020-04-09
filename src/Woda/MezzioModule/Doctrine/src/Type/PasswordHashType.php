<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Doctrine\Type;

use Woda\Core\ValueObject\PasswordHash;

final class PasswordHashType extends AbstractStringValueObjectType
{
    public const NAME = 'password_hash_object_type';

    public function getName(): string
    {
        return self::NAME;
    }

    protected function createValueObject(string $value): object
    {
        return PasswordHash::fromString($value);
    }
}
