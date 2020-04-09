<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Core\Middleware;

use Mezzio\Session\SessionInterface;
use Mezzio\Session\SessionMiddleware as MezzioSessionMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SessionMiddleware implements MiddlewareInterface
{
    /** @var MiddlewareInterface */
    private $middleware;

    public function __construct(MezzioSessionMiddleware $middleware)
    {
        $this->middleware = $middleware;
    }

    public static function extractSession(ServerRequestInterface $request): SessionInterface
    {
        return $request->getAttribute(MezzioSessionMiddleware::SESSION_ATTRIBUTE);
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $this->middleware->process($request, $handler);
    }
}
