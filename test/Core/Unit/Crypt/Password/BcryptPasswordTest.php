<?php

declare(strict_types=1);

namespace WodaTest\Core\Unit\Crypt\Password;

use PHPUnit\Framework\TestCase;
use Woda\Core\Crypt\Password\BcryptPassword;

class BcryptPasswordTest extends TestCase
{
    private BcryptPassword $password;

    public function testCreatedHashVerifiesWithCorrectPassword()
    {
        self::assertTrue($this->password->verify('foo', $this->password->create('foo')));
    }
    public function testCreatedHashDoesNotVerifyWithIncorrectPassword()
    {
        self::assertFalse($this->password->verify('foo', $this->password->create('bar')));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->password = new BcryptPassword();
    }
}
