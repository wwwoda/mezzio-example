<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Admin\Handler\Dashboard;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Woda\MezzioModule\Admin\View\Renderer\AdminTemplateRenderer;
use Woda\MezzioModule\Core\Http\ResponseFactory;

final class DashboardHandler implements RequestHandlerInterface
{
    private AdminTemplateRenderer $template;
    private ResponseFactory $response;

    public function __construct(AdminTemplateRenderer $template, ResponseFactory $response)
    {
        $this->template = $template;
        $this->response = $response;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->response->html($this->template->render($request, 'admin::dashboard', []));
    }
}
