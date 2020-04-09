<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Core\Http;

use Fig\Http\Message\StatusCodeInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Diactoros\Response\TextResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Woda\MezzioModule\Core\View\Renderer\SinglePageTemplateRenderer;

final class ResponseFactory
{
    private const TEMPLATE_403 = 'core::error/403';
    private const TEMPLATE_404 = 'core::error/404';
    /** @var SinglePageTemplateRenderer */
    private $template;

    public function redirect(string $uri, int $statusCode = StatusCodeInterface::STATUS_FOUND): ResponseInterface
    {
        return new RedirectResponse($uri, $statusCode);
    }

    public function forbidden(ServerRequestInterface $request, string $message = ''): ResponseInterface
    {
        return $this->html(
            $this->render($request, self::TEMPLATE_403, $message),
            StatusCodeInterface::STATUS_FORBIDDEN
        );
    }

    public function html(string $html, int $statusCode = StatusCodeInterface::STATUS_OK): ResponseInterface
    {
        return new HtmlResponse($html, $statusCode);
    }

    private function render(ServerRequestInterface $request, string $template, string $message): string
    {
        return $this->template->render($request, $template, ['message' => $message]);
    }

    public function notFound(ServerRequestInterface $request, string $message = ''): ResponseInterface
    {
        return $this->html(
            $this->render($request, self::TEMPLATE_404, $message),
            StatusCodeInterface::STATUS_NOT_FOUND
        );
    }

    public function methodNotAllowed(): ResponseInterface
    {
        return new TextResponse('Method not allowed', StatusCodeInterface::STATUS_METHOD_NOT_ALLOWED);
    }

    public function unauthorized(): ResponseInterface
    {
        return new TextResponse('Unauthorized', StatusCodeInterface::STATUS_UNAUTHORIZED);
    }

    /**
     * @param mixed[] $data
     */
    public function json(array $data): ResponseInterface
    {
        return new JsonResponse($data);
    }
}
