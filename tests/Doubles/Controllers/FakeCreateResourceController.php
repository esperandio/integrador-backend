<?php

declare(strict_types=1);

namespace Test\Doubles\Controllers;

use App\Presentation\Controllers\Ports\{CreateResourceOperation, ControllerTemplate, RequestInput, RequestOutput};

class FakeCreateResourceController extends ControllerTemplate implements CreateResourceOperation
{
    protected function performSpecificOperation(RequestInput $requestInput): RequestOutput
    {
        return new RequestOutput();
    }
}
