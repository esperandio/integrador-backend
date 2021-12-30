<?php

declare(strict_types=1);

namespace App\External\Controllers;

use App\Presentation\Controllers\Ports\{ControllerTemplate, RequestInput, CreateResourceOperation};
use App\External\Controllers\Ports\HttpRequestOutput;
use App\UseCases\Exceptions\NotAllowedException;

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

            if ($this->controllerTemplate instanceof CreateResourceOperation) {
                return $this->created($body);
            }

            return $this->ok($body);
        } catch (NotAllowedException $e) {
            return $this->forbidden($e->getMessage());
        } catch (\Exception $e) {
            return $this->badRequest($e->getMessage());
        }
    }
}
