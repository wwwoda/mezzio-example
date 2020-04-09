<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\Middleware\Queue;

use LogicException;
use SimpleBus\Message\Bus\MessageBus;

use function array_key_exists;
use function get_class;

final class MessageRouter
{
    private const COMMAND_BUS = 'command_bus';
    private const EVENT_BUS = 'event_bus';
    /** @var array */
    private $mapping;
    /** @var MessageBus */
    private $eventBus;
    /** @var MessageBus */
    private $commandBus;

    public function __construct(array $mapping, MessageBus $eventBus, MessageBus $commandBus)
    {
        $this->mapping = $mapping;
        $this->eventBus = $eventBus;
        $this->commandBus = $commandBus;
    }

    public function bus($message): MessageBus
    {
        $messageClass = get_class($message);
        if (array_key_exists($messageClass, $this->mapping[self::COMMAND_BUS])) {
            return $this->commandBus;
        }
        if (array_key_exists($messageClass, $this->mapping[self::EVENT_BUS])) {
            return $this->eventBus;
        }
        throw new LogicException(
            sprintf(
                'Job cant be executed no mapping registered for "%s"',
                $messageClass
            )
        );
    }
}
