<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\Middleware;

use DateTimeImmutable;
use Psr\Log\LoggerInterface;
use SimpleBus\Message\Bus\Middleware\MessageBusMiddleware;

class LoggingMiddleware implements MessageBusMiddleware
{
    /** @var LoggerInterface */
    private $logger;

    /**
     * @var string
     */
    private $level;

    public function __construct(LoggerInterface $logger, string $level)
    {
        $this->logger = $logger;
        $this->level = $level;
    }

    public function handle($message, callable $next)
    {
        $data = ['message' => $message];
        $data['start'] = new DateTimeImmutable();
        $next($message);
        $data['end'] = new DateTimeImmutable();
        $this->logger->log($this->level, 'Handled a message', $data);
    }
}
