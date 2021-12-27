<?php

declare(strict_types=1);

namespace App\Presentation\Controllers\Ports;

class RequestInput
{
    /**
     * @param array<string, int|string> $body
     */
    public function __construct(
        public array $body = []
    ) {
    }
}
