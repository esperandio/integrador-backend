<?php

declare(strict_types=1);

namespace App\UseCases\Ports;

interface Encoder
{
    public function hash(string $password): string;
    public function verify(string $password, string $hash): bool;
}
