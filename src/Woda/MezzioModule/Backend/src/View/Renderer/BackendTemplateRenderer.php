<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Backend\View\Renderer;

use Woda\MezzioModule\Core\View\Renderer\AbstractSiteAreaTemplateRenderer;

final class BackendTemplateRenderer extends AbstractSiteAreaTemplateRenderer
{
    protected function getLayoutTemplateName(): string
    {
        return 'backend::layout';
    }
}
