<?php

declare(strict_types=1);

namespace Test\Entities;

use PHPUnit\Framework\TestCase;
use App\Entities\ModeratorRole;

final class ModeratorRoleTest extends TestCase
{
    public function testDefaultValueEqualsToModerator(): void
    {
        $this->assertEquals('MODERATOR', (new ModeratorRole())->getValue());
    }

    public function testCanCreateGroup(): void
    {
        $this->assertEquals(true, (new ModeratorRole())->getPermissionValueByKey('createGroup'));
    }

    public function testCanCreateUser(): void
    {
        $this->assertEquals(true, (new ModeratorRole())->getPermissionValueByKey('createUser'));
    }
}
