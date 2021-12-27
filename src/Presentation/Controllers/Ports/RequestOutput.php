<?php

declare(strict_types=1);

namespace App\Presentation\Controllers\Ports;

class RequestOutput
{
    /**
     * @param array<string, mixed> $body
     */
    public function __construct(
        public array $body = []
    ) {
    }
}
