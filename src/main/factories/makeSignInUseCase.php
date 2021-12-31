<?php

declare(strict_types=1);

use App\UseCases\SignIn\DefaultCase as SignIn;

function makeSignInUseCase(): SignIn
{
    return new SignIn(makeUserRepository(), makeEncoder(), makeTokenManager());
}
