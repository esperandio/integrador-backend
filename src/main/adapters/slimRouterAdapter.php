<?php

declare(strict_types=1);

use App\External\Controllers\WebController;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Presentation\Controllers\Ports\RequestInput;

function slimRouterAdapter(WebController $controller): \Closure
{
    return function (Request $request, Response $response) use ($controller) {
        /**
         * @var array<string, int|string> $body
         */
        $body = (array) json_decode($request->getBody()->getContents());

        $httpResponse = $controller->handle(new RequestInput(
            body: $body
        ));

        $result = json_encode($httpResponse->body);

        if ($result == false) {
            $result = '';
        }

        $response->getBody()->write($result);

        return $response->withStatus($httpResponse->statusCode);
    };
}
