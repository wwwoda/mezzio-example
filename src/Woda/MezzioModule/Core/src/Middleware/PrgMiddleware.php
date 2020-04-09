<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Core\Middleware;

use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PrgMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $session = SessionMiddleware::extractSession($request);

        if ($request->getMethod() === 'POST') {
            $session->set('post_data', $request->getParsedBody());
            return new RedirectResponse($request->getUri(), 303);
        }

        if ($session->has('post_data')) {
            $post = $session->get('post_data');
            $session->unset('post_data');

            $request = $request->withMethod('POST');
            $request = $request->withParsedBody($post);
        }

        return $handler->handle($request);
    }
}
