<?php

declare(strict_types=1);

namespace Test\Doubles\Controllers;

use App\Presentation\Ports\{RequestInput, RequestOutput};
use App\Presentation\Controllers\Ports\ControllerTemplate;

class ExceptionController extends ControllerTemplate
{
    protected function performSpecificOperation(RequestInput $requestInput): RequestOutput
    {
        throw new \Exception("Error Processing Request");
    }
}
