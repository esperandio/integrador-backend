<?php

declare(strict_types=1);

namespace App\External\Controllers;

use App\Presentation\Ports\RequestInput;
use App\Presentation\Controllers\Ports\{ControllerTemplate, CreateResourceOperation};
use App\Presentation\Middleware\Ports\Middleware;
use App\External\Controllers\Ports\HttpRequestOutput;

class WebController
{
    use HttpHelper;

    public function __construct(
        private ControllerTemplate $controllerTemplate,
        private ?Middleware $middleware = null
    ) {
    }

    public function handle(RequestInput $requestInput): HttpRequestOutput
    {
        try {
            if (!empty($this->middleware)) {
                $this->middleware->handle($requestInput);
            }

            $requestOutput = $this->controllerTemplate->handle($requestInput);

            $body = json_encode($requestOutput->body);

            if ($body == false) {
                $body = "";
            }

            if ($this->controllerTemplate instanceof CreateResourceOperation) {
                return $this->created($body);
            }

            return $this->ok($body);
        } catch (\App\UseCases\Exceptions\NotAllowedException $e) {
            return $this->forbidden($e->getMessage());
        } catch (\App\Presentation\Middleware\Exceptions\UnauthorizedException $e) {
            return $this->unauthorized($e->getMessage());
        } catch (\App\Exceptions\DomainException $e) {
            return $this->badRequest($e->getMessage());
        } catch (\Throwable $e) {
            return $this->serverError($e->getMessage());
        }
    }
}
