<?php

declare(strict_types=1);

namespace App\External\Controllers;

use App\External\Controllers\Ports\HttpRequestOutput;

trait HttpHelper
{
    private function ok(string $body = ""): HttpRequestOutput
    {
        return new HttpRequestOutput(body: $body, statusCode: 200);
    }

    private function created(string $body = ""): HttpRequestOutput
    {
        return new HttpRequestOutput(body: $body, statusCode: 201);
    }

    private function forbidden(string $error = ""): HttpRequestOutput
    {
        return new HttpRequestOutput(body: $error, statusCode: 403);
    }

    private function badRequest(string $error = ""): HttpRequestOutput
    {
        return new HttpRequestOutput(body: $error, statusCode: 400);
    }

    private function serverError(string $error = ""): HttpRequestOutput
    {
        return new HttpRequestOutput(body: $error, statusCode: 500);
    }
}
