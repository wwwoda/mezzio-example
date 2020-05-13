<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus;

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Mezzio\Router\RouterInterface;
use Psr\Container\ContainerInterface;
use Woda\MezzioModule\Core\Router\RouteProvider;
use Woda\MezzioModule\MessageBus\Admin\Log\MessageBusLogHandler;
use Woda\MezzioModule\MessageBus\Log\MessageLogEntry;

use function array_merge;

final class MessageBusRouter implements RouteProvider
{
    private const MESSAGE_BUS_LOG = 'admin.message-bus-log';
    private const MESSAGE_BUS_LOG_ENTRY = 'admin.message-bus-log.entry';
    /** @var RouterInterface */
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function addRoutes(Application $app, MiddlewareFactory $factory, ContainerInterface $container): void
    {
        $app->get('/admin/message-bus-log', MessageBusLogHandler::class, self::MESSAGE_BUS_LOG);
        $app->get('/admin/message-bus-log/:id', MessageBusLogHandler::class, self::MESSAGE_BUS_LOG_ENTRY);
    }

    /**
     * @param array<string, mixed> $substitutions
     * @param array<string, mixed> $options
     */
    public function adminMessageBusLogUri(array $substitutions = [], array $options = []): string
    {
        return $this->router->generateUri(self::MESSAGE_BUS_LOG, $substitutions, $options);
    }

    /**
     * @param array<string, mixed> $substitutions
     * @param array<string, mixed> $options
     */
    public function adminMessageBusLogEntryUri(
        MessageLogEntry $entry,
        array $substitutions = [],
        array $options = []
    ): string {
        return $this->router->generateUri(
            self::MESSAGE_BUS_LOG,
            array_merge(['id' => $entry->getId()], $substitutions),
            $options
        );
    }
}
