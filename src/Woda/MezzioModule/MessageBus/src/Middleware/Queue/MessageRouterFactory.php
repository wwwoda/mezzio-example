<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\Middleware\Queue;

use Psr\Container\ContainerInterface;
use Woda\MessageBus\CommandBus\CommandBus;
use Woda\MessageBus\EventBus\EventBus;
use Woda\MezzioModule\Config\AppConfig;
use Woda\MezzioModule\MessageBus\CommandBus\CommandBusMapping;
use Woda\MezzioModule\MessageBus\EventBus\EventBusMapping;

use function in_array;

final class MessageRouterFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new MessageRouter(
            $this->mapping($container),
            $container->get(EventBus::class),
            $container->get(CommandBus::class)
        );
    }

    private function mapping(ContainerInterface $container): array
    {
        $asyncMapping = AppConfig::fromContainer($container)->array('message_bus/async_messages');
        return [
            'command_bus' => $this->filterArray($container->get(CommandBusMapping::class)(), $asyncMapping),
            'event_bus' => $this->filterArray($container->get(EventBusMapping::class)(), $asyncMapping),
        ];
    }

    private function filterArray(array $mapping, array $allowedKeys): array
    {
        $filtered = [];
        foreach ($mapping as $key => $value) {
            if (!in_array($key, $allowedKeys, true)) {
                continue;
            }
            $filtered[$key] = $value;
        }
        return $filtered;
    }
}
