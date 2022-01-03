<?php

declare(strict_types=1);

namespace App\Presentation\Middleware\Ports;

use App\Presentation\Ports\RequestInput;

interface Middleware
{
    public function handle(RequestInput $requestInput): void;
}
