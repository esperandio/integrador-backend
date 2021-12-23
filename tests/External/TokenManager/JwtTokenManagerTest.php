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
        $token = $tokenManager->sign(new TokenData(id: 1));

        $this->assertEquals(true, $tokenManager->verify($token));
    }
}
