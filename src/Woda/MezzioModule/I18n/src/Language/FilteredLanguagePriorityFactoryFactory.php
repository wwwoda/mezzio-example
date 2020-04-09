<?php

declare(strict_types=1);

namespace Woda\MezzioModule\I18n\Language;

use Laminas\ServiceManager\ConfigInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class FilteredLanguagePriorityFactoryFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): FilteredLanguagePriorityFactory
    {
        return new FilteredLanguagePriorityFactory(
            $container->get(AggregateLanguagePriorityFactory::class),
            $this->getLanguages($container)
        );
    }

    /**
     * @return string[]
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function getLanguages(ContainerInterface $container): array
    {
        return $container->get(ConfigInterface::class)->array('app/i18n/locales');
    }
}
