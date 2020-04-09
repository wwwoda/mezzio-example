<?php

declare(strict_types=1);

namespace Woda\MezzioModule\I18n;

use Woda\MezzioModule\Config\MezzioModuleConfig;
use Woda\MezzioModule\I18n\Language\AggregateLanguagePriorityFactory;
use Woda\MezzioModule\I18n\Language\AggregateLanguagePriorityFactoryFactory;
use Woda\MezzioModule\I18n\Language\FallbackLanguagePriorityFactory;
use Woda\MezzioModule\I18n\Language\LanguagePriorityFactoryInterface;

final class ConfigProvider
{
    public function __invoke(): array
    {
        return MezzioModuleConfig::forModule('i18n')
            ->withConfig(
                [
                    'dependencies' => [
                        'aliases' => [
                            LanguagePriorityFactoryInterface::class => AggregateLanguagePriorityFactory::class,
                        ],
                        'factories' => [
                            AggregateLanguagePriorityFactory::class => AggregateLanguagePriorityFactoryFactory::class,
                        ],
                    ],
                    'i18n' => [
                        'language_priority_factories' => [
                            FallbackLanguagePriorityFactory::class,
                        ],
                    ],
                ]
            )
            ->toArray();
    }
}
