<?php

declare(strict_types=1);

namespace App\Entities;

class AdminRole extends Role
{
    /**
     * @var array<string, bool> $permissions
     */
    protected array $permissions = [
        'createGroup' => true,
        'createUser' => true
    ];

    public function getValue(): string
    {
        return "ADMIN";
    }
}
