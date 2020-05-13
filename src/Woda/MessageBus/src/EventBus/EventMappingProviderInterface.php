<?php declare(strict_types=1);

namespace Woda\MessageBus\EventBus;

interface EventMappingProviderInterface
{
    /**
     * Format: [Event::class => [Listener::class, AnotherListener::class]]
     * @return array<string, array<string>>
     */
    public function __invoke(): array;
}
