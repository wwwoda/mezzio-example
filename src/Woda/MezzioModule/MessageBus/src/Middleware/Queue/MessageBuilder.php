<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\Middleware\Queue;

use Woda\MessageQueue\OutgoingMessage;

interface MessageBuilder
{
    public function build($message): OutgoingMessage;
}
