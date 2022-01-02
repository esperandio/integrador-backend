<?php

declare(strict_types=1);

namespace App\Presentation\Controllers;

use App\Presentation\Ports\{RequestInput, RequestOutput};
use App\Presentation\Controllers\Ports\ControllerTemplate;
use App\UseCases\Ports\{SignInUseCase};
use App\UseCases\SignIn\Ports\AuthenticationParamsData;

class SignInController extends ControllerTemplate
{
    protected array $requiredParams = ['email', 'password'];

    public function __construct(
        private SignInUseCase $signIn
    ) {
    }

    protected function performSpecificOperation(RequestInput $requestInput): RequestOutput
    {
        $requestParams = $requestInput->body;

        $authenticationResultData = $this->signIn->perform(new AuthenticationParamsData(
            email: (string) $requestParams['email'],
            password: (string) $requestParams['password']
        ));

        return new RequestOutput(body: (array) $authenticationResultData);
    }
}
