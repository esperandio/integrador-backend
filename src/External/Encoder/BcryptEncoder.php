<?php

declare(strict_types=1);

namespace App\External\Encoder;

use App\UseCases\Ports\Encoder;

class BcryptEncoder implements Encoder
{
    public function hash(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function verify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}
