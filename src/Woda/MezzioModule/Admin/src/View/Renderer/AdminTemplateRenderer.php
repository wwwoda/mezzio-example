<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Admin\View\Renderer;

use Woda\MezzioModule\Core\View\Renderer\AbstractSiteAreaTemplateRenderer;

final class AdminTemplateRenderer extends AbstractSiteAreaTemplateRenderer
{
    protected function getLayoutTemplateName(): string
    {
        return 'admin::layout';
    }
}
