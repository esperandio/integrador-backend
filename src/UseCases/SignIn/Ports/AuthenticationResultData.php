<?php

declare(strict_types=1);

namespace App\UseCases\SignIn\Ports;

class AuthenticationResultData
{
    public function __construct(
        public string $accessToken = ""
    ) {
    }
}
