<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;
use Woda\MezzioModule\Core\Router\RouteProviderRegistry;

return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container) : void {
    $container->get(RouteProviderRegistry::class)->addRoutes($app, $factory, $container);
};
