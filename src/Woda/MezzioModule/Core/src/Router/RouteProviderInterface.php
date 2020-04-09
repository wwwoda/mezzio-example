<?php

namespace Woda\MezzioModule\Core\Router;

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

interface RouteProviderInterface
{
    public function addRoutes(Application $app, MiddlewareFactory $factory, ContainerInterface $container): void;
}
