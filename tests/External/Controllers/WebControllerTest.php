<?php

declare(strict_types=1);

namespace Test\External\Controllers;

use PHPUnit\Framework\TestCase;
use Test\Doubles\Controllers\{FakeController, ExceptionController};
use App\External\Controllers\WebController;
use App\Presentation\Controllers\Ports\RequestInput;

class WebControllerTest extends TestCase
{
    public function testReturn200WhenControllerOperationPerformedWithSucess(): void
    {
        $controller = new WebController(new FakeController());
        $response = $controller->handle(new RequestInput());

        $this->assertEquals(200, $response->statusCode);
    }

    public function testReturn400WhenControllerOperationFailed(): void
    {
        $controller = new WebController(new ExceptionController());
        $response = $controller->handle(new RequestInput());

        $this->assertEquals(400, $response->statusCode);
    }
}
