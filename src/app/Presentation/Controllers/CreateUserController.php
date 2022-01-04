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
        $userData = $this->createUser->perform(
            createdByUserId: $requestInput->getInt('userId'),
            userData: new UserData(
                email: $requestInput->getString('email'),
                password: $requestInput->getString('password'),
                groupId: $requestInput->getInt('groupId')
            )
        );

        return new RequestOutput(body: (array) $userData);
    }
}
