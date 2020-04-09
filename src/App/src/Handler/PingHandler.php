<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Woda\Core\DateTime\ClockInterface;
use Woda\MezzioModule\Core\Http\ResponseFactory;

final class PingHandler implements RequestHandlerInterface
{
    /** @var ResponseFactory */
    private $response;
    /** @var ClockInterface */
    private $clock;

    public function __construct(ResponseFactory $response, ClockInterface $clock)
    {
        $this->response = $response;
        $this->clock = $clock;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->response->json(['ack' => $this->clock->read()]);
    }
}
