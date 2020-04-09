<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Backend;

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Mezzio\Router\RouterInterface;
use Psr\Container\ContainerInterface;
use Woda\MezzioModule\Backend\Handler\Dashboard\DashboardHandler;
use Woda\MezzioModule\Core\Router\RouteProviderInterface;

final class BackendRouter implements RouteProviderInterface
{
    private const API_PING_ROUTE = '/backend/api/ping';
    private const API_PING = 'backend.api.ping';
    private const DASHBOARD_ROUTE = '/backend';
    private const DASHBOARD = 'backend.dashboard';
    /** @var RouterInterface */
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function addRoutes(Application $app, MiddlewareFactory $factory, ContainerInterface $container): void
    {
        $app->get(self::DASHBOARD_ROUTE, DashboardHandler::class, self::DASHBOARD);
        $app->get(self::API_PING_ROUTE, DashboardHandler::class, self::API_PING);
    }

    /**
     * @param array<string, mixed> $substitutions
     * @param array<string, mixed> $options
     * @return string
     */
    public function dashboardUrl(array $substitutions = [], array $options = []): string
    {
        return $this->router->generateUri(self::DASHBOARD);
    }
}
