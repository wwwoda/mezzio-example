<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Core;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\DelegatorFactoryInterface;
use Woda\MezzioModule\Config\AppConfig;

final class InjectorDecoratorFactory implements DelegatorFactoryInterface
{
    private const GENERATED_INJECTOR_CLASS_NAME = '\\GeneratedInjector';

    public function __invoke(ContainerInterface $container, $name, callable $callback, array $options = null)
    {
        $namespace = $this->getAotNamespace($container);
        $injector = $callback();
        $class = '\\' . $namespace . self::GENERATED_INJECTOR_CLASS_NAME;
        if (class_exists($class)) {
            return new $class($injector);
        }
        return $injector;
    }

    private function getAotNamespace(ContainerInterface $container): string
    {
        return AppConfig::fromContainer($container)->string('dependencies/auto/aot/namespace');
    }
}
