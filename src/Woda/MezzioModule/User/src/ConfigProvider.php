<?php

declare(strict_types=1);

namespace Woda\MezzioModule\User;

use Mezzio\Authentication\UserInterface;
use Woda\MezzioModule\Config\MezzioModuleConfig;
use Woda\MezzioModule\Doctrine\Repository\DoctrineOrmUserRepository;
use Woda\User\Command\UserCommandMappingProvider;
use Woda\User\Repository\UserRepositoryInterface;

final class ConfigProvider
{
    public function __invoke(): array
    {
        return MezzioModuleConfig::forModule('user')
            ->withTemplatePath(__DIR__ . '/../templates/')
            ->withRouteProvider(UserRouter::class)
            ->withCommandBusMapping(UserCommandMappingProvider::class)
            ->withConfig(
                [
                    'dependencies' => [
                        'aliases' => [
                            UserRepositoryInterface::class => DoctrineOrmUserRepository::class,
                        ],
                        'factories' => [
                            UserInterface::class => UserFactory::class,
                        ],
                    ],
                ]
            )
            ->toArray();
    }
}
