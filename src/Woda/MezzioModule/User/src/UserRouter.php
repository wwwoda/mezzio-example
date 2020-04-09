<?php

declare(strict_types=1);

namespace Woda\MezzioModule\User;

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Mezzio\Router\RouterInterface;
use Psr\Container\ContainerInterface;
use Woda\MezzioModule\Core\Router\RouteProviderInterface;
use Woda\MezzioModule\User\App\Login\LoginHandler;
use Woda\MezzioModule\User\App\Logout\LogoutHandler;
use Woda\MezzioModule\User\App\PasswordReset\PasswordResetHandler;
use Woda\MezzioModule\User\App\Register\RegisterHandler;

use function Woda\MezzioModule\Core\formMiddleware;
use function Woda\MezzioModule\Core\userMiddleware;

final class UserRouter implements RouteProviderInterface
{
    private const LOGIN = 'login';
    private const REGISTER = 'register';
    private const LOGOUT = 'logout';
    private const PASSWORD_RESET = 'password-reset';
    /** @var RouterInterface */
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function addRoutes(Application $app, MiddlewareFactory $factory, ContainerInterface $container): void
    {
        $methods = ['GET', 'POST'];
        $app->route('/login', formMiddleware(LoginHandler::class), $methods, self::LOGIN);
        $app->route('/password-reset', formMiddleware(PasswordResetHandler::class), $methods, self::PASSWORD_RESET);
        $app->route('/register', formMiddleware(RegisterHandler::class), $methods, self::REGISTER);
        $app->get('/logout', userMiddleware(LogoutHandler::class), self::LOGOUT);
    }

    /**
     * @param array<string, mixed> $substitutions
     * @param array<string, mixed> $options
     * @return string
     */
    public function loginUrl(array $substitutions = [], array $options = []): string
    {
        return $this->router->generateUri(self::LOGIN);
    }

    /**
     * @param array<string, mixed> $substitutions
     * @param array<string, mixed> $options
     * @return string
     */
    public function logoutUrl(array $substitutions = [], array $options = []): string
    {
        return $this->router->generateUri(self::LOGOUT);
    }

    /**
     * @param array<string, mixed> $substitutions
     * @param array<string, mixed> $options
     * @return string
     */
    public function registerUrl(array $substitutions = [], array $options = []): string
    {
        return $this->router->generateUri(self::REGISTER);
    }
}
