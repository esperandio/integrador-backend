<?php

declare(strict_types=1);

namespace Test\Doubles\Controllers;

use App\Presentation\Controllers\Ports\{ControllerTemplate, RequestInput, RequestOutput};

class FakeController extends ControllerTemplate
{
    protected function performSpecificOperation(RequestInput $requestInput): RequestOutput
    {
        return new RequestOutput();
    }
}
