<?php

declare(strict_types=1);

namespace App\UseCases\Factories\Ports;

class EventData
{
    public function __construct(
        public string $key = "",
        public string $dateTime = "",
        public int $minimumMillisecondsIdleTimeAllowed = 0,
    ) {
    }
}
