<?php

declare(strict_types=1);

namespace App\UseCases\Ports;

interface CreateUserUseCase
{
    public function perform(int $createdByUserId, UserData $userData): UserData;
}
