<?php

declare(strict_types=1);

namespace Test\External\Controllers;

use PHPUnit\Framework\TestCase;
use Test\Doubles\Controllers\{
    FakeController,
    FakeCreateResourceController,
    ExceptionController,
    NotAllowedExceptionController
};
use App\External\Controllers\WebController;
use App\Presentation\Controllers\Ports\RequestInput;

class WebControllerTest extends TestCase
{
    public function testReturn200WhenDefaultOperationPerformedWithSucess(): void
    {
        $controller = new WebController(new FakeController());
        $response = $controller->handle(new RequestInput());

        $this->assertEquals(200, $response->statusCode);
    }

    public function testReturn201WhenCreateResourceOperationPerformedWithSucess(): void
    {
        $controller = new WebController(new FakeCreateResourceController());
        $response = $controller->handle(new RequestInput());

        $this->assertEquals(201, $response->statusCode);
    }

    public function testReturn403WhenUserNotAllowed(): void
    {
        $controller = new WebController(new NotAllowedExceptionController());
        $response = $controller->handle(new RequestInput());

        $this->assertEquals(403, $response->statusCode);
    }

    public function testReturn400WhenControllerOperationFailed(): void
    {
        $controller = new WebController(new ExceptionController());
        $response = $controller->handle(new RequestInput());

        $this->assertEquals(400, $response->statusCode);
    }
}
