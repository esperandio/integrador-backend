<?php

declare(strict_types=1);

namespace App\Entities;

use App\Entities\Exceptions\DomainException;

class Group
{
    private function __construct(
        private string $name,
        private int $minimumMillisecondsIdleTimeAllowed,
        private Role $role
    ) {
    }

    public static function create(string $name, int $minimumMillisecondsIdleTimeAllowed, Role $role): Group
    {
        if (empty($name)) {
            throw new DomainException('Group\'s name MUST NOT BE empty!');
        }

        if ($minimumMillisecondsIdleTimeAllowed <= 0) {
            throw new DomainException('Group\'s minimum idle time MUST BE greater than 0 milliseconds!');
        }

        return new Group(
            name: $name,
            minimumMillisecondsIdleTimeAllowed: $minimumMillisecondsIdleTimeAllowed,
            role: $role
        );
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMinimumMillisecondsIdleTimeAllowed(): int
    {
        return $this->minimumMillisecondsIdleTimeAllowed;
    }

    public function getRole(): Role
    {
        return clone $this->role;
    }
}
