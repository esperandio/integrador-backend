<?php

declare(strict_types=1);

namespace App\UseCases\SignIn\Ports;

class AuthenticationParamsData
{
    public function __construct(
        public string $email = "",
        public string $password = ""
    ) {
    }
}
