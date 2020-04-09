<?php

declare(strict_types=1);

namespace Woda\Core\DateTime;

use DateTimeImmutable;

interface ClockInterface
{
    public function read(): DateTimeImmutable;
}
