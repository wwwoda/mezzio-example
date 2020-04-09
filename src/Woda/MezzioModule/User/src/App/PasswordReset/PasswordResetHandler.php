<?php

declare(strict_types=1);

namespace Woda\MezzioModule\User\App\PasswordReset;

use App\View\Renderer\AppTemplateRenderer;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function time;

final class PasswordResetHandler implements RequestHandlerInterface
{
    /** @var AppTemplateRenderer */
    private $template;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse(['ack' => time()]);
    }
}
