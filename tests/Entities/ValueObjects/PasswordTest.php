<?php

declare(strict_types=1);

namespace Test\Entities\ValueObjects;

use PHPUnit\Framework\TestCase;
use App\Entities\ValueObjects\Password;
use App\Entities\Exceptions\InvalidPasswordException;

final class PasswordTest extends TestCase
{
    public function testCanBeCreatedFromValidPassword(): void
    {
        $this->assertInstanceOf(
            Password::class,
            Password::create('abcABC123')
        );
    }

    public function testCannotBeCreatedFromInvalidPassword(): void
    {
        $this->expectException(InvalidPasswordException::class);

        Password::create('invalid');
    }

    public function testCanBeUsedAsString(): void
    {
        $this->assertEquals(
            'abcABC123',
            Password::create('abcABC123')->__toString()
        );
    }
}
