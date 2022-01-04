<?php

declare(strict_types=1);

namespace Test\External\TokenManager;

use PHPUnit\Framework\TestCase;
use App\External\TokenManager\JwtTokenManager;
use App\UseCases\SignIn\Ports\TokenData;

class JwtTokenManagerTest extends TestCase
{
    public function testCanCorrectlySignAndVerifyAToken(): void
    {
        $tokenManager = new JwtTokenManager("secret");
        $token = $tokenManager->sign(new TokenData(userId: 1));

        $this->assertEquals(true, $tokenManager->verify($token));
    }

    public function testReturnFalseWhenTokenIsInvalid(): void
    {
        $tokenManager = new JwtTokenManager("secret");
        $token = $tokenManager->sign(new TokenData(userId: 1));

        $this->assertEquals(false, $tokenManager->verify($token . 'invalid'));
    }

    public function testReturnFalseWhenTokenIsExpired(): void
    {
        $tokenManager = new JwtTokenManager("secret");
        $token = $tokenManager->sign(
            tokenData: new TokenData(userId: 1),
            expirationDate: (new \DateTimeImmutable())->sub(new \DateInterval('P1D'))
        );

        $this->assertEquals(false, $tokenManager->verify($token));
    }
}
