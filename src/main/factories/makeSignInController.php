<?php

declare(strict_types=1);

use App\External\Controllers\WebController;
use App\Presentation\Controllers\SignInController;

function makeSignInController(): WebController
{
    return new WebController(new SignInController(makeSignInUseCase()));
}
