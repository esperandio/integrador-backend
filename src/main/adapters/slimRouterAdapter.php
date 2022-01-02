<?php

declare(strict_types=1);

use App\External\Controllers\WebController;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Presentation\Ports\RequestInput;

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

        $response->getBody()->write($httpResponse->body);

        return $response
            ->withStatus($httpResponse->statusCode)
            ->withHeader('Content-type', 'application/json');
    };
}
