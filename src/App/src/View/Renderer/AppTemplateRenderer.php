<?php

declare(strict_types=1);

namespace App\View\Renderer;

use Woda\MezzioModule\Core\View\Renderer\AbstractSiteAreaTemplateRenderer;

final class AppTemplateRenderer extends AbstractSiteAreaTemplateRenderer
{
    protected function getLayoutTemplateName(): string
    {
        return 'layout::default';
    }
}
