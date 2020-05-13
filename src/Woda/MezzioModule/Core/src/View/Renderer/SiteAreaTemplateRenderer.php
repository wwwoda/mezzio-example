<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Core\View\Renderer;

use Laminas\View\Model\ViewModel;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ServerRequestInterface;
use Woda\MezzioModule\Authentication\Middleware\MezzioAuthenticationMiddleware;
use Woda\MezzioModule\I18n\Language\LanguagePriority;
use Woda\MezzioModule\I18n\Middleware\LanguagePriorityMiddleware;

final class SiteAreaTemplateRenderer
{
    private TemplateRendererInterface $templateRenderer;

    public function __construct(TemplateRendererInterface $templateRenderer)
    {
        $this->templateRenderer = $templateRenderer;
    }

    /**
     * @param array<string, mixed> $params
     */
    public function render(ServerRequestInterface $request, string $template, array $params = []): string
    {
        $languages = LanguagePriorityMiddleware::languages($request);
        $params['layout'] = $this->buildLayoutViewModel($languages, $request);
        $params['languages'] = $languages;
        return $this->templateRenderer->render($template, $params);
    }

    private function buildLayoutViewModel(
        LanguagePriority $languages,
        ServerRequestInterface $request
    ): ViewModel {
        $user = MezzioAuthenticationMiddleware::user($request);
        $layout = new ViewModel(
            [
                'languages' => $languages,
                'user' => $user,
                'request' => $request,
            ]
        );
        $layout->setTemplate($this->getLayoutTemplateName());
        return $layout;
    }
}
