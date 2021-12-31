<?php

declare(strict_types=1);

namespace Test\External\Controllers;

use PHPUnit\Framework\TestCase;
use Test\Doubles\Controllers\{
    FakeController,
    FakeCreateResourceController,
    ExceptionController,
    DomainExceptionController,
    NotAllowedExceptionController
};
use App\External\Controllers\WebController;
use App\Presentation\Controllers\Ports\RequestInput;

class WebControllerTest extends TestCase
{
    public function testReturn200WhenOperationPerformedWithSuccess(): void
    {
        $controller = new WebController(new FakeController());
        $response = $controller->handle(new RequestInput());

        $this->assertEquals(200, $response->statusCode);
    }

    public function testReturn201WhenCreateResourceOperationPerformedWithSuccess(): void
    {
        $controller = new WebController(new FakeCreateResourceController());
        $response = $controller->handle(new RequestInput());

        $this->assertEquals(201, $response->statusCode);
    }

    public function testReturn400WhenControllerOperationFailedWithADomainException(): void
    {
        $controller = new WebController(new DomainExceptionController());
        $response = $controller->handle(new RequestInput());

        $this->assertEquals(400, $response->statusCode);
    }

    public function testReturn403WhenOperationFailedWithANotAllowedException(): void
    {
        $controller = new WebController(new NotAllowedExceptionController());
        $response = $controller->handle(new RequestInput());

        $this->assertEquals(403, $response->statusCode);
    }

    public function testReturn500WhenControllerOperationFailedWithDefaultAException(): void
    {
        $controller = new WebController(new ExceptionController());
        $response = $controller->handle(new RequestInput());

        $this->assertEquals(500, $response->statusCode);
    }
}
