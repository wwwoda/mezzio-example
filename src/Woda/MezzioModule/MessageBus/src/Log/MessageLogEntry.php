<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\Log;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use LogicException;
use Ramsey\Uuid\UuidInterface;

class MessageLogEntry
{
    /** @var UuidInterface */
    private $id;
    /** @var string */
    private $class;
    /** @var DateTime */
    private $start;
    /** @var DateTime */
    private $end;
    /** @var array */
    private $data;

    public function getClass(): string
    {
        return $this->class;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getStart(): DateTimeImmutable
    {
        return $this->ensureDateTimeImmutable($this->start);
    }

    private function ensureDateTimeImmutable(DateTimeInterface $dateTime): DateTimeImmutable
    {
        if ($dateTime instanceof DateTimeImmutable) {
            return $dateTime;
        }
        if (!$dateTime instanceof DateTime) {
            throw new LogicException();
        }
        return DateTimeImmutable::createFromMutable($dateTime);
    }

    public function getEnd(): DateTimeImmutable
    {
        return $this->ensureDateTimeImmutable($this->end);
    }

    public function getId(): string
    {
        return $this->id->toString();
    }
}
