<?php

declare(strict_types=1);

namespace Test\Presentation\Controllers;

use PHPUnit\Framework\TestCase;
use Test\Doubles\UseCases\{FakeCreateUser, ExceptionCreateUser};
use App\Presentation\Controllers\CreateUserController;
use App\Presentation\Ports\{RequestInput, RequestOutput};
use App\Presentation\Controllers\Exceptions\MissingParamException;
use Exception;

class CreateUserControllerTest extends TestCase
{
    public function testThrowsExceptionWhenMissingControllerParam(): void
    {
        $this->expectException(MissingParamException::class);

        $controller = new CreateUserController(new FakeCreateUser());
        $controller->handle(new RequestInput());
    }

    public function testReturnRequestOutputInstaceWhenPerfomedWithSuccess(): void
    {
        $controller = new CreateUserController(new FakeCreateUser());
        $requestOutput = $controller->handle($this->getDefaultRequestInput());

        $this->assertInstanceOf(RequestOutput::class, $requestOutput);
    }

    public function testThrowsExceptionWhenUseCaseFails(): void
    {
        $this->expectException(Exception::class);

        $controller = new CreateUserController(new ExceptionCreateUser());
        $controller->handle($this->getDefaultRequestInput());
    }

    private function getDefaultRequestInput(): RequestInput
    {
        return new RequestInput(
            body: [
                'userId' => 1,
                'email' => 'user@example.com',
                'password' => 'abc',
                'groupId' => 1
            ]
        );
    }
}
