<?php

declare(strict_types=1);

namespace Test\Entities\ValueObjects;

use PHPUnit\Framework\TestCase;
use App\Entities\ValueObjects\Email;
use App\Entities\Exceptions\InvalidEmailException;

final class EmailTest extends TestCase
{
    public function testCanBeCreatedFromValidEmailAddress(): void
    {
        $this->assertInstanceOf(
            Email::class,
            Email::create('user@example.com')
        );
    }

    public function testCannotBeCreatedFromInvalidEmailAddress(): void
    {
        $this->expectException(InvalidEmailException::class);

        Email::create('invalid');
    }

    public function testCanBeUsedAsString(): void
    {
        $this->assertEquals(
            'user@example.com',
            Email::create('user@example.com')->__toString()
        );
    }
}
