<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Backend;

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Mezzio\Router\RouterInterface;
use Psr\Container\ContainerInterface;
use Woda\MezzioModule\Authentication\Middleware\MezzioAuthenticationMiddleware;
use Woda\MezzioModule\Backend\Handler\Dashboard\DashboardHandler;
use Woda\MezzioModule\Core\Middleware\MezzioSessionMiddleware;
use Woda\MezzioModule\Core\Router\PipeProvider;
use Woda\MezzioModule\Core\Router\RouteProvider;

final class BackendRouter implements RouteProvider, PipeProvider
{
    private const ROUTE_API_PING = '/backend/api/ping';
    private const ROUTE_BACKEND = '/backend';
    private const NAME_API_PING = 'backend.api.ping';
    private const NAME_DASHBOARD = 'backend.dashboard';
    private RouterInterface $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function addRoutes(Application $app, MiddlewareFactory $factory, ContainerInterface $container): void
    {
        $app->get(self::ROUTE_BACKEND, DashboardHandler::class, self::NAME_DASHBOARD);
        $app->get(self::ROUTE_API_PING, DashboardHandler::class, self::NAME_API_PING);
    }

    public function addPipe(Application $app, MiddlewareFactory $factory, ContainerInterface $container): void
    {
        $app->pipe(self::ROUTE_BACKEND, [
            MezzioSessionMiddleware::class,
            MezzioAuthenticationMiddleware::class,
        ]);
    }

    /**
     * @param array<string, mixed> $substitutions
     * @param array<string, mixed> $options
     * @return string
     */
    public function dashboardUrl(array $substitutions = [], array $options = []): string
    {
        return $this->router->generateUri(self::ROUTE_BACKEND);
    }
}
