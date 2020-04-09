<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Authentication\Middleware;

use Mezzio\Authentication\AuthenticationInterface;
use Mezzio\Authentication\UserInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class AuthenticationMiddleware implements MiddlewareInterface
{
    private const USER = 'user';
    /**
     * @var AuthenticationInterface
     */
    protected $auth;

    public function __construct(AuthenticationInterface $auth)
    {
        $this->auth = $auth;
    }

    public static function user(ServerRequestInterface $request): ?UserInterface
    {
        return $request->getAttribute(self::USER);
    }

    /**
     * {@inheritDoc}
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $user = $this->auth->authenticate($request);
        return $user === null
            ? $this->auth->unauthorizedResponse($request)
            : $handler->handle($request->withAttribute(self::USER, $user)->withAttribute(UserInterface::class, $user));
    }
}
