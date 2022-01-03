<?php

declare(strict_types=1);

namespace App\UseCases\SignIn\Ports;

use DateTimeImmutable;

interface TokenManager
{
    public function sign(TokenData $tokenData, ?DateTimeImmutable $expirationDate = null): string;
    public function decode(string $token): TokenData;
    public function verify(string $token): bool;
}
