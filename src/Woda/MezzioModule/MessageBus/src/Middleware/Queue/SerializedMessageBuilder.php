<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\Middleware\Queue;

use Woda\MessageQueue\OutgoingMessage;

final class SerializedMessageBuilder implements MessageBuilder
{
    /** @var MessageSerializer */
    private $serializer;

    public function __construct(MessageSerializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function build($message): OutgoingMessage
    {
        return new OutgoingMessage($this->serializer->serialize($message));
    }
}
