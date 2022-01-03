<?php

declare(strict_types=1);

namespace App\Presentation\Middleware;

use App\UseCases\SignIn\Ports\TokenManager;
use App\Presentation\Ports\{RequestInput, RequestOutput};
use App\Presentation\Middleware\Exceptions\UnauthorizedException;
use App\Presentation\Middleware\Ports\Middleware;

class AuthenticationMiddleware implements Middleware
{
    public function __construct(
        private TokenManager $tokenManager
    ) {
    }

    public function handle(RequestInput $requestInput): RequestOutput
    {
        try {
            $token = isset($requestInput->body['authorization'])
                ? (string) $requestInput->body['authorization']
                : '';

            $token = str_replace('Bearer ', '', $token);

            $tokenData = $this->tokenManager->decode($token);

            return new RequestOutput(
                body: (array) $tokenData
            );
        } catch (\Exception $e) {
            throw new UnauthorizedException();
        }
    }
}
