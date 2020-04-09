<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Core\View\Renderer;

final class SinglePageTemplateRenderer extends AbstractSiteAreaTemplateRenderer
{
    protected function getLayoutTemplateName(): string
    {
        return 'core::layout-single-page';
    }
}
