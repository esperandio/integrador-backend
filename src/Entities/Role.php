<?php

declare(strict_types=1);

namespace App\Entities;

interface Role
{
    public function getValue(): string;
    public function canCreateGroup(): bool;
    public function canCreateUser(): bool;
}
