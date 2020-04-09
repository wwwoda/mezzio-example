<?php

declare(strict_types=1);

namespace Woda\MezzioModule\User\App\Logout;

use Mezzio\Authentication\AuthenticationInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class LogoutHandler implements RequestHandlerInterface
{
    /** @var AuthenticationInterface */
    private $auth;

    public function __construct(AuthenticationInterface $auth)
    {
        $this->auth = $auth;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->auth->unauthorizedResponse($request);
    }
}
