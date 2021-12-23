<?php

declare(strict_types=1);

namespace App\UseCases\Ports;

class UserData
{
    public function __construct(
        public string $email = "",
        public string $password = "",
        public int $groupId = 0,
        public int $id = 0
    ) {
    }
}
