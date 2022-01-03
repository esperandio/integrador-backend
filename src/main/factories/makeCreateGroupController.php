<?php

declare(strict_types=1);

use App\External\Controllers\WebController;
use App\Presentation\Controllers\CreateGroupController;

function makeCreateGroupController(): WebController
{
    return new WebController(
        new CreateGroupController(makeCreateGroupUseCase()),
        makeAuthenticationMiddleware()
    );
}
