<?php

declare(strict_types=1);

namespace App\Presentation\Controllers;

use App\Presentation\Ports\{RequestInput, RequestOutput};
use App\Presentation\Controllers\Ports\{CreateResourceOperation, ControllerTemplate};
use App\UseCases\Ports\{CreateUserUseCase, UserData};

class CreateUserController extends ControllerTemplate implements CreateResourceOperation
{
    protected array $requiredParams = ['userId', 'email', 'password', 'groupId'];

    public function __construct(
        private CreateUserUseCase $createUser
    ) {
    }

    protected function performSpecificOperation(RequestInput $requestInput): RequestOutput
    {
        $requestParams = $requestInput->body;

        $userData = $this->createUser->perform(
            createdByUserId: (int) $requestParams['userId'],
            userData: new UserData(
                email: (string) $requestParams['email'],
                password: (string) $requestParams['password'],
                groupId: (int) $requestParams['groupId']
            )
        );

        return new RequestOutput(body: (array) $userData);
    }
}
