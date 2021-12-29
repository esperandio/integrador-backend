<?php

declare(strict_types=1);

use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (RouteCollectorProxy $group) {
    $group->get('/hello', function (Request $request, Response $response, $args) {
        $name = 'world';
        $response->getBody()->write("Hello, $name");
        return $response;
    });
};
