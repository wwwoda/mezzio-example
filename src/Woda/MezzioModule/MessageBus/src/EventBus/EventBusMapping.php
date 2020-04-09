<?php

namespace Woda\MezzioModule\MessageBus\EventBus;

final class EventBusMapping
{
    /**
     * @var array<string, array<string, string>>
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
