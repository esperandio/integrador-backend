<?php

declare(strict_types=1);

namespace Test\Presentation\Controllers;

use PHPUnit\Framework\TestCase;
use Test\Doubles\UseCases\{FakeSignIn, ExceptionSignIn};
use App\Presentation\Controllers\SignInController;
use App\Presentation\Controllers\Ports\{RequestInput, RequestOutput};
use App\Presentation\Controllers\Exceptions\MissingParamException;
use Exception;

class SignInControllerTest extends TestCase
{
    public function testThrowsExceptionWhenMissingControllerParam(): void
    {
        $this->expectException(MissingParamException::class);

        $controller = new SignInController(new FakeSignIn());
        $controller->handle(new RequestInput());
    }

    public function testReturnRequestOutputInstaceWhenPerfomedWithSuccess(): void
    {
        $controller = new SignInController(new FakeSignIn());
        $requestOutput = $controller->handle($this->getDefaultRequestInput());

        $this->assertInstanceOf(RequestOutput::class, $requestOutput);
    }

    public function testThrowsExceptionWhenUseCaseFails(): void
    {
        $this->expectException(Exception::class);

        $controller = new SignInController(new ExceptionSignIn());
        $controller->handle($this->getDefaultRequestInput());
    }

    private function getDefaultRequestInput(): RequestInput
    {
        return new RequestInput(
            body: [
                'email' => 'user@example.com',
                'password' => 'abc'
            ]
        );
    }
}
