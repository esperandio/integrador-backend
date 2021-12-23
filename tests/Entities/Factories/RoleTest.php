<?php

declare(strict_types=1);

namespace Test\Entities\Factories;

use PHPUnit\Framework\TestCase;
use App\Entities\Factories\Role;
use App\Entities\{AdminRole, ModeratorRole, ClientRole};
use App\Entities\Exceptions\RoleKeyNotFoundException;

final class RoleTest extends TestCase
{
    public function testReturnAdminRoleInstance(): void
    {
        $this->assertInstanceOf(AdminRole::class, Role::create('ADMIN'));
    }

    public function testReturnModeratorRoleInstance(): void
    {
        $this->assertInstanceOf(ModeratorRole::class, Role::create('MODERATOR'));
    }

    public function testReturnClientRoleInstance(): void
    {
        $this->assertInstanceOf(ClientRole::class, Role::create('CLIENT'));
    }

    public function testThrowsExceptionWhenKeyIsInvalid(): void
    {
        $this->expectException(RoleKeyNotFoundException::class);

        Role::create('invalid');
    }
}
