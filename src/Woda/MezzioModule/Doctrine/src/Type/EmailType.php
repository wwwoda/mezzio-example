<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Doctrine\Type;

use Woda\Core\ValueObject\Email;

final class EmailType extends AbstractStringValueObjectType
{
    public const NAME = 'email_object_type';

    public function getName(): string
    {
        return self::NAME;
    }

    protected function createValueObject(string $value): object
    {
        return Email::fromString($value);
    }
}
