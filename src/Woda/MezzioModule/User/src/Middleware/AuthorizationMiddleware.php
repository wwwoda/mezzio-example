<?php

declare(strict_types=1);

namespace Woda\MezzioModule\User\Middleware;

use Mezzio\Authorization\AuthorizationInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Woda\MezzioModule\Authentication\Middleware\AuthenticationMiddleware;
use Woda\MezzioModule\Core\Http\ResponseFactory;

class AuthorizationMiddleware implements MiddlewareInterface
{
    /** @var AuthorizationInterface */
    private $authorization;
    /** @var ResponseFactory */
    private $responseFactory;

    public function __construct(AuthorizationInterface $authorization, ResponseFactory $responseFactory)
    {
        $this->authorization = $authorization;
        $this->responseFactory = $responseFactory;
    }

    /**
     * {@inheritDoc}
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $user = AuthenticationMiddleware::user($request);
        if ($user === null) {
            return $this->responseFactory->unauthorized();
        }

        foreach ($user->getRoles() as $role) {
            if ($this->authorization->isGranted($role, $request)) {
                return $handler->handle($request);
            }
        }
        return $this->responseFactory->forbidden($request, 'Role permission missing');
    }
}
