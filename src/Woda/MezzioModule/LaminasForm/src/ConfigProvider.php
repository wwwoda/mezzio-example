<?php

declare(strict_types=1);

namespace Woda\MezzioModule\LaminasForm;

final class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'form_elements' => [

            ],
            'dependencies' => [
                'aliases' => [
                    FormElementManagerInterface::class => LaminasFormElementManager::class,
                ],
                'factories' => [
                    PolyfillFormElementManager::class => PolyfillFormElementManagerFactory::class,
                ],
            ],
        ];
    }
}
