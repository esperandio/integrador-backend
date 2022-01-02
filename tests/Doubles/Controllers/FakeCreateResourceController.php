<?php

declare(strict_types=1);

namespace Test\Doubles\Controllers;

use App\Presentation\Ports\{RequestInput, RequestOutput};
use App\Presentation\Controllers\Ports\{CreateResourceOperation, ControllerTemplate};

class FakeCreateResourceController extends ControllerTemplate implements CreateResourceOperation
{
    protected function performSpecificOperation(RequestInput $requestInput): RequestOutput
    {
        return new RequestOutput();
    }
}
