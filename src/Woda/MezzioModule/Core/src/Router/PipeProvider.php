<?php

namespace Woda\MezzioModule\Core\Router;

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

interface PipeProvider
{
    public function addPipe(Application $app, MiddlewareFactory $factory, ContainerInterface $container): void;
}
