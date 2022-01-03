<?php

declare(strict_types=1);

namespace App\Presentation\Middleware\Ports;

use App\Presentation\Ports\{RequestInput, RequestOutput};

interface Middleware
{
    public function handle(RequestInput $requestInput): RequestOutput;
}
