<?php

declare(strict_types=1);

namespace App\Handler;

use App\View\Renderer\AppTemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Woda\MezzioModule\Core\Http\ResponseFactory;
use Woda\MezzioModule\Core\View\Renderer\SinglePageTemplateRenderer;

final class HomeHandler implements RequestHandlerInterface
{
    /** @var SinglePageTemplateRenderer */
    private $template;
    /** @var ResponseFactory */
    private $response;

    public function __construct(AppTemplateRenderer $template, ResponseFactory $responseFactory)
    {
        $this->template = $template;
        $this->response = $responseFactory;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->response->html($this->template->render($request, 'app::home', [
            'containerName' => 'Laminas Servicemanager',
            'containerDocs' => 'https://docs.laminas.dev/laminas-servicemanager/',
            'routerName' => 'Laminas Router',
            'routerDocs' => 'https://docs.laminas.dev/laminas-router/',
            'templateName' => 'Laminas View',
            'templateDocs' => 'https://docs.laminas.dev/laminas-view/',
        ]));
    }
}
