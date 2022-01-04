<?php

declare(strict_types=1);

namespace Test\Entities;

use PHPUnit\Framework\TestCase;
use App\Entities\AdminRole;

final class AdminRoleTest extends TestCase
{
    public function testDefaultValueEqualsToAdmin(): void
    {
        $this->assertEquals('ADMIN', (new AdminRole())->getValue());
    }

    public function testCanCreateGroup(): void
    {
        $this->assertEquals(true, (new AdminRole())->getPermissionValueByKey('createGroup'));
    }

    public function testCanCreateUser(): void
    {
        $this->assertEquals(true, (new AdminRole())->getPermissionValueByKey('createUser'));
    }
}
