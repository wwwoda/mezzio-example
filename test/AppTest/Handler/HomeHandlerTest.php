<?php

declare(strict_types=1);

namespace AppTest\Handler;

use App\AppRouter;
use Fig\Http\Message\StatusCodeInterface;
use PHPUnit\Framework\TestCase;
use Trinet\MezzioTest\MezzioTestEnvironment;

class HomeHandlerTest extends TestCase
{
    private MezzioTestEnvironment $mezzioApp;
    private AppRouter $router;

    protected function setUp()
    {
        parent::setUp();
        $this->mezzioApp = new MezzioTestEnvironment();
        $this->router = $this->mezzioApp->container()->get(AppRouter::class);
    }

    public function testReturns200()
    {
        $response = $this->mezzioApp->dispatch($this->router->homeUri());

        self::assertSame(StatusCodeInterface::STATUS_OK, $response->getStatusCode());
    }
}
