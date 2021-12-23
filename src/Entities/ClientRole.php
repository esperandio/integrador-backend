<?php

declare(strict_types=1);

namespace App\Entities;

class ClientRole implements Role
{
    public function getValue(): string
    {
        return "CLIENT";
    }

    public function canCreateGroup(): bool
    {
        return false;
    }

    public function canCreateUser(): bool
    {
        return false;
    }
}
