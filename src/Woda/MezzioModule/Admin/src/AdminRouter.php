<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Admin;

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Mezzio\Router\RouterInterface;
use Psr\Container\ContainerInterface;
use Woda\MezzioModule\Admin\Handler\Dashboard\DashboardHandler;
use Woda\MezzioModule\Core\Router\RouteProviderInterface;

use function Woda\MezzioModule\Core\adminMiddleware;

final class AdminRouter implements RouteProviderInterface
{
    private const DASHBOARD = 'admin.dashboard';
    private const ROOT_ROUTE = '/admin';
    private RouterInterface $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function addRoutes(Application $app, MiddlewareFactory $factory, ContainerInterface $container): void
    {
        $app->get(self::ROOT_ROUTE, adminMiddleware(DashboardHandler::class), self::DASHBOARD);
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
