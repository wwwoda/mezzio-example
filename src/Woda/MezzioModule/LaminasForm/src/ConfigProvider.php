<?php

declare(strict_types=1);

namespace Woda\MezzioModule\LaminasForm;

use Woda\Form\FormElementManager;

final class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'form_elements' => [

            ],
            'dependencies' => [
                'aliases' => [
                    FormElementManager::class => LaminasFormElementManager::class,
                ],
                'factories' => [
                    PolyfillFormElementManager::class => PolyfillFormElementManagerFactory::class,
                ],
            ],
        ];
    }
}
