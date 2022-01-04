<?php

declare(strict_types=1);

namespace Test\Entities;

use PHPUnit\Framework\TestCase;
use App\Entities\ClientRole;

final class ClientRoleTest extends TestCase
{
    public function testDefaultValueEqualsToClient(): void
    {
        $this->assertEquals('CLIENT', (new ClientRole())->getValue());
    }

    public function testCannotCreateGroup(): void
    {
        $this->assertEquals(false, (new ClientRole())->getPermissionValueByKey('createGroup'));
    }

    public function testCannotCreateUser(): void
    {
        $this->assertEquals(false, (new ClientRole())->getPermissionValueByKey('createUser'));
    }
}
