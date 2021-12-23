<?php

declare(strict_types=1);

namespace App\UseCases\Ports;

class GroupData
{
    public function __construct(
        public string $name = "",
        public int $minimumMillisecondsIdleTimeAllowed = 0,
        public string $roleKey = "",
        public int $id = 0
    ) {
    }
}
