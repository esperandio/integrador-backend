<?php

declare(strict_types=1);

use App\UseCases\CreateGroup\DefaultCase as CreateGroup;

function makeCreateGroupUseCase(): CreateGroup
{
    return new CreateGroup(makeUserRepository(), makeGroupRepository());
}
