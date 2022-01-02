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
        return $this->getErrorHttpRequestOutput($error, 403);
    }

    private function badRequest(string $error = ""): HttpRequestOutput
    {
        return $this->getErrorHttpRequestOutput($error, 400);
    }

    private function serverError(string $error = ""): HttpRequestOutput
    {
        return $this->getErrorHttpRequestOutput($error, 500);
    }

    private function getErrorHttpRequestOutput(string $error, int $statusCode): HttpRequestOutput
    {
        $json = json_encode([
            'error' => $error
        ]);

        if ($json == false) {
            $json = "";
        }

        return new HttpRequestOutput(
            body: $json,
            statusCode: $statusCode
        );
    }
}
