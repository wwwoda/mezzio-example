<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\Middleware\Queue;

use function get_class;
use function in_array;

final class ClassNames implements ShouldBeQueued
{
    /** @var string[] */
    private $classNames;

    public function __construct(string ...$classNames)
    {
        $this->classNames = $classNames;
    }

    public function __invoke($message): bool
    {
        return in_array(get_class($message), $this->classNames, true);
    }
}
