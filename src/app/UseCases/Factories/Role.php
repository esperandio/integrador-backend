<?php

declare(strict_types=1);

namespace App\UseCases\Factories;

use App\Entities\{Role as RoleInterface, AdminRole, ModeratorRole, ClientRole};
use App\Entities\Exceptions\RoleKeyNotFoundException;

class Role
{
    public static function create(string $roleKey): RoleInterface
    {
        switch ($roleKey) {
            case 'ADMIN':
                return new AdminRole();
            case 'MODERATOR':
                return new ModeratorRole();
            case 'CLIENT':
                return new ClientRole();
        }

        throw new RoleKeyNotFoundException($roleKey);
    }
}
