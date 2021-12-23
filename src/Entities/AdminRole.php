<?php

declare(strict_types=1);

namespace App\Entities;

class AdminRole implements Role
{
    public function getValue(): string
    {
        return "ADMIN";
    }

    public function canCreateGroup(): bool
    {
        return true;
    }

    public function canCreateUser(): bool
    {
        return true;
    }
}
