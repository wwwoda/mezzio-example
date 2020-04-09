<?php

declare(strict_types=1);

namespace Woda\User\Command;

use Woda\MessageBus\CommandBus\CommandMappingProvider;

final class UserCommandMappingProvider implements CommandMappingProvider
{
    /**
     * @inheritDoc
     */
    public function __invoke(): array
    {
        return [
            RegisterUser::class => RegisterUserHandler::class,
        ];
    }
}
