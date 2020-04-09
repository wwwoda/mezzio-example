<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Core\View\Renderer;

interface RendererInterface
{
    /**
     * @param array<string, mixed>|null $params
     */
    public function render(string $content, ?array $params = null): string;
}
