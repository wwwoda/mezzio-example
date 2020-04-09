<?php

declare(strict_types=1);

namespace App;

use App\Handler\HomeHandler;
use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Mezzio\Router\RouterInterface;
use Psr\Container\ContainerInterface;
use Woda\MezzioModule\Core\Router\RouteProviderInterface;

final class AppRouter implements RouteProviderInterface
{
    private const HOME = 'home';
    /** @var RouterInterface */
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function addRoutes(Application $app, MiddlewareFactory $factory, ContainerInterface $container): void
    {
        $app->get('/', HomeHandler::class, self::HOME);
    }

    /**
     * @param array<string, mixed> $substitutions
     * @param array<string, mixed> $options
     */
    public function homeUri(array $substitutions = [], array $options = []): string
    {
        return $this->router->generateUri(self::HOME, $substitutions, $options);
    }
}
