<?php

declare(strict_types=1);

use App\UseCases\CreateUser\DefaultCase as CreateUser;

function makeCreateUserUseCase(): CreateUser
{
    return new CreateUser(makeUserRepository(), makeGroupRepository(), makeEncoder());
}
