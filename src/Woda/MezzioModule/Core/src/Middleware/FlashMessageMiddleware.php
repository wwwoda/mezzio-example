<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Core\Middleware;

use Mezzio\Flash\FlashMessageMiddleware as MezzioFlashMessengerMiddleware;
use Mezzio\Flash\FlashMessagesInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FlashMessageMiddleware implements MiddlewareInterface
{
    /** @var MezzioFlashMessengerMiddleware */
    private $middleware;

    public function __construct(MezzioFlashMessengerMiddleware $middleware)
    {
        $this->middleware = $middleware;
    }

    public static function extractFlash(ServerRequestInterface $request): FlashMessagesInterface
    {
        return $request->getAttribute(MezzioFlashMessengerMiddleware::FLASH_ATTRIBUTE);
    }

    /**
     * @inheritDoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $this->middleware->process($request, $handler);
    }
}
