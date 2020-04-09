<?php

declare(strict_types=1);

namespace Woda\Core\DateTime;

use DateTimeImmutable;

final class StaticClock implements ClockInterface
{
    private DateTimeImmutable $now;

    public function __construct(DateTimeImmutable $now)
    {
        $this->now = $now;
    }

    public function read(): DateTimeImmutable
    {
        return $this->now;
    }
}
