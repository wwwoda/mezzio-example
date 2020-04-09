<?php

declare(strict_types=1);

namespace Woda\MezzioModule\LaminasForm;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Config;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Woda\MezzioModule\Config\AppConfig;

class PolyfillFormElementManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $name, ?array $options = null)
    {
        $pluginManager = new PolyfillFormElementManager($container, $options ?? []);
        $delegator = new Config(AppConfig::fromContainer($container)->array('form_elements'));
        return $delegator->configureServiceManager($pluginManager);
    }
}
