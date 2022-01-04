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

    public function getPermissionValueByKey(string $key): bool
    {
        if (!array_key_exists($key, $this->permissions)) {
            return false;
        }

        return $this->permissions[$key];
    }

    abstract public function getValue(): string;
}
