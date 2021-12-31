<?php

declare(strict_types=1);

namespace Test\Entities;

use PHPUnit\Framework\TestCase;
use App\Entities\Group;
use App\Entities\AdminRole;
use App\Exceptions\DomainException;

final class GroupTest extends TestCase
{
    public function testCanBeCreatedFromValidData(): void
    {
        $validName = 'Group Example';
        $validMinimumMillisecondsIdleTimeAllowed = 1000;

        $this->assertInstanceOf(
            Group::class,
            Group::create(
                name: $validName,
                minimumMillisecondsIdleTimeAllowed: $validMinimumMillisecondsIdleTimeAllowed,
                role: new AdminRole()
            )
        );
    }

    public function testThrowsExceptionWhenNameIsInvalid(): void
    {
        $this->expectException(DomainException::class);

        $invalidName = '';
        $validMinimumMillisecondsIdleTimeAllowed = 1000;

        Group::create(
            name: $invalidName,
            minimumMillisecondsIdleTimeAllowed: $validMinimumMillisecondsIdleTimeAllowed,
            role: new AdminRole()
        );
    }

    public function testThrowsExceptionWhenMinimumIdleTimeIsInvalid(): void
    {
        $this->expectException(DomainException::class);

        $validName = 'Group Example';
        $invalidMinimumMillisecondsIdleTimeAllowed = -1;

        Group::create(
            name: $validName,
            minimumMillisecondsIdleTimeAllowed: $invalidMinimumMillisecondsIdleTimeAllowed,
            role: new AdminRole()
        );
    }
}
