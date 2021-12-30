<?php

declare(strict_types=1);

namespace App\UseCases\Ports;

interface UserRepository
{
    public function add(UserData $userData): UserData;
    public function findUserByEmail(string $email): ?UserData;
    public function findUserById(int $id): ?UserData;
    public function count(): int;
}
