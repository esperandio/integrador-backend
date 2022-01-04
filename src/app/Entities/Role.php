<?php

declare(strict_types=1);

namespace App\Entities;

abstract class Role
{
    private const DEFAULT_PERMISSION_VALUE = false;

    /**
     * @var array<string, bool> $permissions
     */
    protected array $permissions = [
        'createGroup' => self::DEFAULT_PERMISSION_VALUE,
        'createUser' => self::DEFAULT_PERMISSION_VALUE
    ];

    private function getPermissionValueByKey(string $key): bool
    {
        if (!array_key_exists($key, $this->permissions)) {
            return false;
        }

        return $this->permissions[$key];
    }

    public function canCreateGroup(): bool
    {
        return $this->getPermissionValueByKey('createGroup');
    }

    public function canCreateUser(): bool
    {
        return $this->getPermissionValueByKey('createUser');
    }

    abstract public function getValue(): string;
}
