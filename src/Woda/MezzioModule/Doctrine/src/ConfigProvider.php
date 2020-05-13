<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Doctrine;

use Doctrine\DBAL\Driver\PDOSqlite\Driver;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Driver\XmlDriver;
use Roave\PsrContainerDoctrine\EntityManagerFactory;
use Woda\MezzioModule\Config\MezzioModuleConfig;
use Woda\MezzioModule\Doctrine\Type\EmailType;
use Woda\MezzioModule\Doctrine\Type\PasswordHashType;

final class ConfigProvider
{
    public function __invoke()
    {
        return MezzioModuleConfig::forModule('doctrine')
            ->withConfig(
                [
                    'dependencies' => [
                        'aliases' => [
                            EntityManagerInterface::class => 'doctrine.entity_manager.orm_default',
                        ],
                        'factories' => [
                            'doctrine.entity_manager.orm_default' => EntityManagerFactory::class,
                        ],
                    ],
                    'doctrine' => [
                        'types' => [
                            EmailType::NAME => EmailType::class,
                            PasswordHashType::NAME => PasswordHashType::class,
                        ],
                        'configuration' => [
                            'orm_default' => [
                                'params' => [
                                    'charset' => 'UTF8',
                                ],
                            ],
                        ],
                        'connection' => [
                            'orm_default' => [
                                'driverClass' => Driver::class,
                                'params' => [
                                    'url' => 'sqlite:///data/database.sqlite'
                                ],
                                'doctrine_mapping_types' => [
                                ]
                            ],
                        ],
                        'driver' => [
                            'orm_default' => [
                                'class' => XmlDriver::class,
                                'cache' => 'array',
                                'paths' => __DIR__ . '/../mapping/orm',
                            ],
                        ],
                    ],

                    /*'doctrine' => [
                        'driver' => [
                            'orm_xml' => [
                                'class' => XmlDriver::class,
                                'cache' => 'array',
                                'paths' => MappingFileLocation::getOrmLocations(),
                            ],
                            'mongodb_xml' => [
                                'class' => MongodbXmlDriver::class,
                                'cache' => 'array',
                                'paths' => MappingFileLocation::getMongoDbLocations(),
                            ],
                            __NAMESPACE__ . '\ORM' => [
                                'class' => XmlDriver::class,
                                'cache' => 'array',
                                'paths' => [dirname(__DIR__) . '/mapping/orm/'],
                            ],
                            'orm_default' => [
                                'drivers' => [
                                    __NAMESPACE__ . '\\' => __NAMESPACE__ . '\ORM',
                                    'Eventjet\\' => 'orm_xml',
                                ],
                            ],
                            __NAMESPACE__ . '\MongoDB' => [
                                'class' => MongodbXmlDriver::class,
                                'cache' => 'array',
                                'paths' => [dirname(__DIR__) . '/mapping/mongodb/'],
                            ],
                            'odm_default' => [
                                'drivers' => [
                                    __NAMESPACE__ . '\\' => __NAMESPACE__ . '\MongoDB',
                                    'Eventjet\\' => 'mongodb_xml',
                                ],
                            ],
                        ],
                        'configuration' => [
                            'orm_default' => [
                                'EntityListenerResolver' => OrmContainerEntityListenerResolver::class,
                                'types' => OrmTypeProvider::getTypes(),
                            ],
                            'odm_default' => [
                                'types' => MongoDbTypeProvider::getTypes(),
                            ],
                        ],
                        'eventmanager' => [
                            'odm_default' => [
                                'subscribers' => [
                                    MongoDbEventSubscriber::class,
                                ],
                            ],
                            'orm_default' => [
                                'subscribers' => [
                                    OrmEventSubscriber::class,
                                ],
                            ],
                        ],
                    ],*/
                ]
            )
            ->toArray();
    }
}
