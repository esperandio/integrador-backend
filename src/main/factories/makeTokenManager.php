<?php

declare(strict_types=1);

use App\UseCases\SignIn\Ports\TokenManager;
use App\External\TokenManager\JwtTokenManager;

function makeTokenManager(): TokenManager
{
    return new JwtTokenManager($_ENV['JWT_SECRET']);
}
