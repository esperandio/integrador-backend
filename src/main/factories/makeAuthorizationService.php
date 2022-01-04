<?php

declare(strict_types=1);

use App\UseCases\Ports\AuthorizationService;
use App\UseCases\Authorization\DefaultService;

function makeAuthorizationService(): AuthorizationService
{
    return new DefaultService(makeUserRepository(), makeGroupRepository());
}
