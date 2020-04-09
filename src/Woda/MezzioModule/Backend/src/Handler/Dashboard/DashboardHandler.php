<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Backend\Handler\Dashboard;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Woda\MezzioModule\Backend\View\Renderer\BackendTemplateRenderer;
use Woda\MezzioModule\Core\Http\ResponseFactory;

final class DashboardHandler implements RequestHandlerInterface
{
    /** @var BackendTemplateRenderer */
    private $template;
    /** @var ResponseFactory */
    private $response;

    public function __construct(BackendTemplateRenderer $template, ResponseFactory $response)
    {
        $this->template = $template;
        $this->response = $response;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->response->html($this->template->render($request, 'backend::dashboard', []));
    }
}
