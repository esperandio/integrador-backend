<?php

declare(strict_types=1);

namespace App\Presentation\Middleware;

use App\UseCases\SignIn\Ports\TokenManager;
use App\Presentation\Ports\RequestInput;
use App\Presentation\Middleware\Exceptions\UnauthorizedException;
use App\Presentation\Middleware\Ports\Middleware;

class AuthenticationMiddleware implements Middleware
{
    public function __construct(
        private TokenManager $tokenManager
    ) {
    }

    public function handle(RequestInput $requestInput): void
    {
        $token = (string) $requestInput->body['authorization'];
        $token = str_replace('Bearer ', '', $token);

        $success = $this->tokenManager->verify($token);

        if (!$success) {
            throw new UnauthorizedException();
        }
    }
}
