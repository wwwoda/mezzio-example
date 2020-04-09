<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Core\Router;

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

final class RouteProviderRegistry implements RouteProviderInterface
{
    /** @var RouteProviderInterface[] */
    private $registeredProvider;

    public function __construct(RouteProviderInterface ...$registeredProvider)
    {
        $this->registeredProvider = $registeredProvider;
    }

    public function addRoutes(Application $app, MiddlewareFactory $factory, ContainerInterface $container): void
    {
        foreach ($this->registeredProvider as $provider) {
            $provider->addRoutes($app, $factory, $container);
        }
    }
}
