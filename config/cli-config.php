<?php

use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\Migrations\Configuration\Configuration;
use Doctrine\Migrations\Tools\Console\Helper\ConfigurationHelper;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Helper\HelperSet;
use Woda\MezzioModule\Config\Config;

$globalConfig = function (ContainerInterface $container): Config {
    return $container->get(Config::class);
};
$container = require 'container.php';
$entityManager = $container->get('doctrine.entity_manager.orm_default');
$connection = $entityManager->getConnection();
$configuration = new Configuration($connection);
$configuration->setMigrationsNamespace($globalConfig($container)->string('doctrine/migrations/namespace'));
$configuration->setMigrationsDirectory($globalConfig($container)->string('doctrine/migrations/directory'));
return new HelperSet(
    [
        'db' => new ConnectionHelper($connection),
        'em' => new EntityManagerHelper($entityManager),
        new ConfigurationHelper($connection, $configuration)
    ]
);
