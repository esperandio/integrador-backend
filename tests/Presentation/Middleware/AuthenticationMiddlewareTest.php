<?php

declare(strict_types=1);

namespace Test\Presentation\Middleware;

use PHPUnit\Framework\TestCase;
use Test\Doubles\TokenManager\FakeTokenManager;
use App\Presentation\Middleware\AuthenticationMiddleware;
use App\Presentation\Middleware\Exceptions\UnauthorizedException;
use App\Presentation\Ports\{RequestInput, RequestOutput};

class AuthenticationMiddlewareTest extends TestCase
{
    public function testReturnRequestOutputInstaceWhenPerfomedWithSuccess(): void
    {
        $authenticationMiddleware = new AuthenticationMiddleware(new FakeTokenManager());
        $requestOutput = $authenticationMiddleware->handle($this->getDefaultRequestInput());

        $this->assertInstanceOf(RequestOutput::class, $requestOutput);
        $this->assertEquals(1, $requestOutput->body['userId']);
    }

    public function testThrowsExceptionWhenUseCaseFails(): void
    {
        $this->expectException(UnauthorizedException::class);

        $authenticationMiddleware = new AuthenticationMiddleware(new FakeTokenManager());
        $authenticationMiddleware->handle($this->getDefaultRequestInput(''));
    }

    private function getDefaultRequestInput(string $authorization = '1SIGNED'): RequestInput
    {
        return new RequestInput(
            body: [
                'authorization' => $authorization
            ]
        );
    }
}
