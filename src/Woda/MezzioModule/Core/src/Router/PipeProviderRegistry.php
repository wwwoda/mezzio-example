<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Core\Router;

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

final class PipeProviderRegistry implements PipeProvider
{
    /** @var PipeProvider[] */
    private array $routePipes;

    public function __construct(PipeProvider ...$routePipes)
    {
        $this->routePipes = $routePipes;
    }

    public function addPipe(Application $app, MiddlewareFactory $factory, ContainerInterface $container): void
    {
        foreach ($this->routePipes as $provider) {
            $provider->addPipe($app, $factory, $container);
        }
    }
}
