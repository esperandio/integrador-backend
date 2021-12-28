<?php

declare(strict_types=1);

namespace Test\Doubles\UseCases;

use App\UseCases\Ports\{SignInUseCase};
use App\UseCases\SignIn\Ports\{AuthenticationParamsData, AuthenticationResultData};

class ExceptionSignIn implements SignInUseCase
{
    public function perform(AuthenticationParamsData $authenticationParamsData): AuthenticationResultData
    {
        throw new \Exception("Error Processing Request");
    }
}
