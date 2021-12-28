<?php

declare(strict_types=1);

namespace Test\Doubles\Controllers;

use App\Presentation\Controllers\Ports\{ControllerTemplate, RequestInput, RequestOutput};
use App\UseCases\Exceptions\NotAllowedException;

class NotAllowedExceptionController extends ControllerTemplate
{
    protected function performSpecificOperation(RequestInput $requestInput): RequestOutput
    {
        throw new NotAllowedException("Error Processing Request");
    }
}
