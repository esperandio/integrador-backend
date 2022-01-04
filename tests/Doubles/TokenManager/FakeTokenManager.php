<?php

declare(strict_types=1);

namespace Test\Doubles\TokenManager;

use App\UseCases\SignIn\Ports\{TokenManager, TokenData};
use DateTimeImmutable;

class FakeTokenManager implements TokenManager
{
    public function sign(TokenData $tokenData, ?DateTimeImmutable $expirationDate = null): string
    {
        return $tokenData->userId . 'SIGNED';
    }

    public function decode(string $token): TokenData
    {
        if (!$this->verify($token)) {
            throw new \Exception("Invalid token");
        }

        return new TokenData(userId: (int) str_replace('SIGNED', '', $token));
    }

    public function verify(string $token): bool
    {
        if (str_ends_with($token, 'SIGNED')) {
            return true;
        }

        return false;
    }
}
