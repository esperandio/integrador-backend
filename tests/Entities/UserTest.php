<?php

declare(strict_types=1);

namespace Test\Entities;

use PHPUnit\Framework\TestCase;
use App\Entities\User;
use App\Entities\Group;
use App\Entities\AdminRole;
use Exception;

final class UserTest extends TestCase
{
    public function testCanBeCreatedFromValidData(): void
    {
        $validEmail = 'user@example.com';
        $validPassword = 'abcABC123';
        $validGroup = Group::create(
            name: 'Group Example',
            minimumMillisecondsIdleTimeAllowed: 1,
            role: new AdminRole()
        );

        $this->assertInstanceOf(
            User::class,
            User::create(
                email: $validEmail,
                password: $validPassword,
                group: $validGroup
            )
        );
    }

    public function testThrowsExceptionWhenEmailIsInvalid(): void
    {
        $this->expectException(Exception::class);

        $invalidEmail = 'invalid';
        $validPassword = 'abcABC123';
        $validGroup = Group::create(
            name: 'Group Example',
            minimumMillisecondsIdleTimeAllowed: 1,
            role: new AdminRole()
        );

        $this->assertInstanceOf(
            User::class,
            User::create(
                email: $invalidEmail,
                password: $validPassword,
                group: $validGroup
            )
        );
    }

    public function testThrowsExceptionWhenPasswordIsInvalid(): void
    {
        $this->expectException(Exception::class);

        $validEmail = 'user@example.com';
        $invalidPassword = 'invalid';
        $validGroup = Group::create(
            name: 'Group Example',
            minimumMillisecondsIdleTimeAllowed: 1,
            role: new AdminRole()
        );

        $this->assertInstanceOf(
            User::class,
            User::create(
                email: $validEmail,
                password: $invalidPassword,
                group: $validGroup
            )
        );
    }
}
