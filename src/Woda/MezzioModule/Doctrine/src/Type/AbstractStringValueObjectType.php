<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

use function is_object;
use function is_string;
use function method_exists;

abstract class AbstractStringValueObjectType extends Type
{
    /**
     * @param array<string, mixed> $fieldDeclaration
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
    }

    /**
     * @param object|string $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if ($value === null) {
            return null;
        }
        if (is_string($value)) {
            return $value;
        }
        if (!is_object($value)) {
            return null;
        }
        if (method_exists($value, 'toString')) {
            return $value->toString();
        }
        if (method_exists($value, '__toString')) {
            return (string)$value;
        }
        return null;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?object
    {
        return !is_string($value) ? null : $this->createValueObject($value);
    }

    abstract protected function createValueObject(string $value): object;

    abstract public function getName(): string;
}
