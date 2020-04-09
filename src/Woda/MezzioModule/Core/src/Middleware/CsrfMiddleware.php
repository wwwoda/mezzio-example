<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Core\Middleware;

use Mezzio\Csrf\CsrfGuardInterface;
use Mezzio\Csrf\CsrfMiddleware as MezzioCsrfMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CsrfMiddleware implements MiddlewareInterface
{
    /** @var MiddlewareInterface */
    private $middleware;

    public function __construct(MezzioCsrfMiddleware $middleware)
    {
        $this->middleware = $middleware;
    }

    public static function extractGuard(ServerRequestInterface $request): CsrfGuardInterface
    {
        return $request->getAttribute(MezzioCsrfMiddleware::GUARD_ATTRIBUTE);
    }

    /**
     * @inheritDoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $this->middleware->process($request, $handler);
    }
}
