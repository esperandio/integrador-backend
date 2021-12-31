<?php

declare(strict_types=1);

namespace Test\Doubles\Controllers;

use App\Presentation\Controllers\Ports\{ControllerTemplate, RequestInput, RequestOutput};

class DomainExceptionController extends ControllerTemplate
{
    protected function performSpecificOperation(RequestInput $requestInput): RequestOutput
    {
        throw new \App\Exceptions\DomainException("Error Processing Request");
    }
}
