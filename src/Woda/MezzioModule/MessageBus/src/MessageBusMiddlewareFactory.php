<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus;

use Psr\Container\ContainerInterface;
use SimpleBus\Message\Bus\Middleware\MessageBusMiddleware;
use SimpleBus\Message\Bus\Middleware\MessageBusSupportingMiddleware;
use Woda\MezzioModule\Config\AppConfig;
use Woda\MezzioModule\MessageBus\Middleware\Queue\MessageQueueMiddleware;

final class MessageBusMiddlewareFactory
{
    public static function fromContainer(ContainerInterface $container, string $key): MessageBusSupportingMiddleware
    {
        $middlewares = AppConfig::fromContainer($container)->array(sprintf('%s/middlewares', $key));
        $middlewares = array_filter($middlewares);
        if (AppConfig::fromContainer($container)->bool('message_bus/async')) {
            array_unshift($middlewares, MessageQueueMiddleware::class);
        }
        return new MessageBusSupportingMiddleware(
            array_map(
                static function (string $middlewareName) use ($container): MessageBusMiddleware {
                    return $container->get($middlewareName);
                },
                $middlewares
            )
        );
    }
}
