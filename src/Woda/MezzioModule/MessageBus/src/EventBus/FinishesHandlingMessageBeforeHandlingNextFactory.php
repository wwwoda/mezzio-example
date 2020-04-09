<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\EventBus;

use SimpleBus\Message\Bus\Middleware\FinishesHandlingMessageBeforeHandlingNext;

class FinishesHandlingMessageBeforeHandlingNextFactory
{
    public function __invoke(): FinishesHandlingMessageBeforeHandlingNext
    {
        return new FinishesHandlingMessageBeforeHandlingNext();
    }
}
