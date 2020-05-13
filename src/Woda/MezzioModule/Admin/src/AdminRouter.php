<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Admin;

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Mezzio\Router\RouterInterface;
use Psr\Container\ContainerInterface;
use Woda\MezzioModule\Admin\Handler\Dashboard\DashboardHandler;
use Woda\MezzioModule\Core\Router\PipeProvider;
use Woda\MezzioModule\Core\Router\RouteProvider;

final class AdminRouter implements RouteProvider, PipeProvider
{
    private const DASHBOARD = 'admin.dashboard';
    private RouterInterface $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function addRoutes(Application $app, MiddlewareFactory $factory, ContainerInterface $container): void
    {
        $app->get('/admin', DashboardHandler::class, self::DASHBOARD);
    }

    public function addPipe(Application $app, MiddlewareFactory $factory, ContainerInterface $container): void
    {
        // TODO: Add Middleware for admin route
    }

    /**
     * @param array<string, mixed> $substitutions
     * @param array<string, mixed> $options
     */
    public function dashboardUrl(array $substitutions = [], array $options = []): string
    {
        return $this->router->generateUri(self::DASHBOARD);
    }
}
