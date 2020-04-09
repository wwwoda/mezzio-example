<?php

declare(strict_types=1);

namespace Woda\Core\DateTime;

use DateTimeImmutable;

final class SystemClock implements ClockInterface
{
    public function read(): DateTimeImmutable
    {
        return new DateTimeImmutable();
    }
}
