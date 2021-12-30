<?php

declare(strict_types=1);

namespace App\External\Controllers\Ports;

class HttpRequestOutput
{
    public function __construct(
        public string $body = "",
        public int $statusCode = 0
    ) {
    }
}
