<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\Middleware\Queue;

use Psr\Container\ContainerInterface;
use Woda\MezzioModule\Config\Config;

final class ClassNamesFactory
{
    public function __invoke(ContainerInterface $container): ClassNames
    {
        return new ClassNames(...$this->config($container)->array('message_bus/async_messages'));
    }

    public function config(ContainerInterface $container): Config
    {
        return $container->get(Config::class);
    }
}
