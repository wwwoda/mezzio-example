<?php declare(strict_types=1);

namespace Woda\MessageBus\EventBus;

interface EventMappingProvider
{
    /**
     * Format: [Event::class => [Listener::class, AnotherListener::class]]
     * @return array<string, array<string>>
     */
    public function __invoke(): array;
}
