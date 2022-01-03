<?php

declare(strict_types=1);

namespace App\External\TokenManager;

use App\UseCases\SignIn\Ports\{TokenManager, TokenData};
use Firebase\JWT\{JWT, Key};
use DateTimeImmutable;
use DateInterval;

class JwtTokenManager implements TokenManager
{
    public function __construct(
        private string $secret
    ) {
    }

    public function sign(TokenData $tokenData, ?DateTimeImmutable $expirationDate = null): string
    {
        if (empty($expirationDate)) {
            $expirationDate = (new DateTimeImmutable())->add(new DateInterval('PT30S'));
        }

        $jwtTokenAdditionalData = [
            'exp' => $expirationDate->getTimestamp(),
            'iat' => (new DateTimeImmutable())->getTimestamp()
        ];

        $payload = array_merge((array) $tokenData, $jwtTokenAdditionalData);

        return JWT::encode($payload, $this->secret, 'HS256');
    }

    public function decode(string $token): TokenData
    {
        $payload = (array) JWT::decode($token, new Key($this->secret, 'HS256'));

        return new TokenData(id: $payload['id']);
    }

    public function verify(string $token): bool
    {
        try {
            JWT::decode($token, new Key($this->secret, 'HS256'));
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
