<?php

declare(strict_types=1);

namespace Woda\MezzioModule\I18n\Language;

use Psr\Container\ContainerInterface;

class AggregateLanguagePriorityFactoryFactory
{
    public function __invoke(ContainerInterface $container): AggregateLanguagePriorityFactory
    {
        return new AggregateLanguagePriorityFactory($this->getFactories($container));
    }

    /**
     * @return LanguagePriorityFactoryInterface[]
     */
    private function getFactories(ContainerInterface $container): array
    {
        return array_map(
            function (string $serviceName) use ($container): LanguagePriorityFactoryInterface {
                return $container->get($serviceName);
            },
            $container->get('config')['i18n']['language_priority_factories']
        );
    }
}
