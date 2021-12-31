<?php

declare(strict_types=1);

use App\External\Controllers\WebController;
use App\Presentation\Controllers\CreateUserController;

function makeCreateUserController(): WebController
{
    return new WebController(new CreateUserController(makeCreateUserUseCase()));
}
