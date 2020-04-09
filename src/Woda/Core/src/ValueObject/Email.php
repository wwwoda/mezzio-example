<?php

declare(strict_types=1);

namespace Woda\Core\ValueObject;

use Woda\Core\Filter\Email as EmailFilter;

final class Email
{
    private string $email;

    private function __construct(string $email)
    {
        if (!EmailFilter::isValid($email)) {
            throw new \RuntimeException('Email is not valid');
        }
        $this->email = $email;
    }

    public static function fromString(string $email): self
    {
        return new self($email);
    }

    public function toString(): string
    {
        return $this->email;
    }

    public function equals(self $other): bool
    {
        return $this->email === $other->email;
    }
}
