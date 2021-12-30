<?php

declare(strict_types=1);

namespace App\UseCases\Ports;

use App\UseCases\SignIn\Ports\{AuthenticationParamsData, AuthenticationResultData};

interface SignInUseCase
{
    public function perform(AuthenticationParamsData $authenticationParamsData): AuthenticationResultData;
}
