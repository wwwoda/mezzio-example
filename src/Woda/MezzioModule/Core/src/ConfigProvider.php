<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Core;

use Mezzio\Authorization\Acl\LaminasAcl;
use Mezzio\Authorization\AuthorizationInterface;
use Woda\Core\Crypt\Password\PasswordInterface;
use Woda\Core\DateTime\ClockInterface;
use Woda\Core\DateTime\SystemClock;
use Woda\MezzioModule\Config\MezzioModuleConfig;
use Woda\MezzioModule\Core\Crypt\Password\LaminasBcryptPasswordInterface;
use Woda\MezzioModule\Core\Router\PipeProvider;
use Woda\MezzioModule\Core\Router\PipeProviderRegistry;
use Woda\MezzioModule\Core\Router\PipeProviderRegistryFactory;
use Woda\MezzioModule\Core\Router\RouteProvider;
use Woda\MezzioModule\Core\Router\RouteProviderRegistry;
use Woda\MezzioModule\Core\Router\RouteProviderRegistryFactory;
use Woda\MezzioModule\Core\View\Helper\Flash;
use Woda\MezzioModule\I18n\Language\FallbackLanguagePriorityFactory;
use Woda\MezzioModule\I18n\Language\LanguagePriorityFactoryInterface;

final class ConfigProvider
{
    public function __invoke()
    {
        return MezzioModuleConfig::forModule('core')
            ->withTemplatePath(__DIR__ . '/../templates/')
            ->withConfig(
                [
                    'woda' => [
                        'route_provider' => [],
                        'pipe_provider' => [],
                    ],
                    'dependencies' => [
                        'aliases' => [
                            AuthorizationInterface::class => LaminasAcl::class,
                            ClockInterface::class => SystemClock::class,
                            LanguagePriorityFactoryInterface::class => FallbackLanguagePriorityFactory::class,
                            PasswordInterface::class => LaminasBcryptPasswordInterface::class,
                            PipeProvider::class => PipeProviderRegistry::class,
                            RouteProvider::class => RouteProviderRegistry::class,
                        ],
                        'factories' => [
                            PipeProviderRegistry::class => PipeProviderRegistryFactory::class,
                            RouteProviderRegistry::class => RouteProviderRegistryFactory::class,
                        ],
                    ],
                    'view_helpers' => [
                        'invokables' => [
                            Flash::class
                        ],
                        'aliases' => [
                            'flash' => Flash::class,
                        ],
                    ],
                ]
            )
            ->toArray();
    }
}
