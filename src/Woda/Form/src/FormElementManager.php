<?php declare(strict_types=1);

namespace Woda\Form;

interface FormElementManager
{
    /**
     * @param array<string, mixed> $options
     */
    public function get(string $name, ?array $options = null): object;
}
