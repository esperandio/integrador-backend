<?php

declare(strict_types=1);

namespace Test\Presentation\Controllers;

use PHPUnit\Framework\TestCase;
use Test\Doubles\UseCases\{FakeCreateGroup, ExceptionCreateGroup};
use App\Presentation\Controllers\CreateGroupController;
use App\Presentation\Controllers\Ports\{RequestInput, RequestOutput};
use App\Presentation\Controllers\Exceptions\MissingParamException;
use Exception;

class CreateGroupControllerTest extends TestCase
{
    public function testThrowsExceptionWhenMissingControllerParam(): void
    {
        $this->expectException(MissingParamException::class);

        $controller = new CreateGroupController(new FakeCreateGroup());
        $controller->handle(new RequestInput());
    }

    public function testReturnRequestOutputInstaceWhenPerfomedWithSuccess(): void
    {
        $controller = new CreateGroupController(new FakeCreateGroup());
        $requestOutput = $controller->handle($this->getDefaultRequestInput());

        $this->assertInstanceOf(RequestOutput::class, $requestOutput);
    }

    public function testThrowsExceptionWhenUseCaseFails(): void
    {
        $this->expectException(Exception::class);

        $controller = new CreateGroupController(new ExceptionCreateGroup());
        $controller->handle($this->getDefaultRequestInput());
    }

    private function getDefaultRequestInput(): RequestInput
    {
        return new RequestInput(
            body: [
                'userId' => 1,
                'name' => 'Example',
                'minimumMillisecondsIdleTimeAllowed' => 10000,
                'roleKey' => 'ADMIN'
            ]
        );
    }
}
