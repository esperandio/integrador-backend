<?php

declare(strict_types=1);

use App\Presentation\Middleware\AuthenticationMiddleware;

function makeAuthenticationMiddleware(): AuthenticationMiddleware
{
    return new AuthenticationMiddleware(makeTokenManager());
}
