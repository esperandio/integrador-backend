<?php

declare(strict_types=1);

namespace Test\Doubles\UseCases;

use App\UseCases\Ports\{CreateUserUseCase, UserData};

class ExceptionCreateUser implements CreateUserUseCase
{
    public function perform(int $createdByUserId, UserData $userData): UserData
    {
        throw new \Exception("Error Processing Request");
    }
}
