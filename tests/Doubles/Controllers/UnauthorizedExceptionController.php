<?php

declare(strict_types=1);

namespace Test\Doubles\Controllers;

use App\Presentation\Controllers\Ports\{ControllerTemplate, RequestInput, RequestOutput};
use App\Presentation\Middleware\Exceptions\UnauthorizedException;

class UnauthorizedExceptionController extends ControllerTemplate
{
    protected function performSpecificOperation(RequestInput $requestInput): RequestOutput
    {
        throw new UnauthorizedException();
    }
}
