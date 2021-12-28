<?php

declare(strict_types=1);

namespace App\External\Controllers;

use App\Presentation\Controllers\Ports\{ControllerTemplate, RequestInput};
use App\External\Controllers\Ports\HttpRequestOutput;

class WebController
{
    use HttpHelper;

    public function __construct(
        private ControllerTemplate $controllerTemplate
    ) {
    }

    public function handle(RequestInput $requestInput): HttpRequestOutput
    {
        try {
            $requestOutput = $this->controllerTemplate->handle($requestInput);

            $body = json_encode($requestOutput->body);

            if ($body == false) {
                $body = "";
            }

            return $this->ok($body);
        } catch (\Exception $e) {
            return $this->badRequest($e->getMessage());
        }
    }
}
