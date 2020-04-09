<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\CommandBus;

final class CommandBusMapping
{
    /**
     * @var array<string, string>
     */
    private $mapping;

    public function __construct(array $mapping)
    {
        $this->mapping = $mapping;
    }

    public function __invoke(): array
    {
        return $this->mapping;
    }
}
