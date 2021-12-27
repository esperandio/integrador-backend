<?php

declare(strict_types=1);

namespace App\Presentation\Controllers;

use App\Presentation\Controllers\Ports\{ControllerTemplate, RequestInput, RequestOutput};
use App\UseCases\Ports\{CreateGroupUseCase, GroupData};

class CreateGroupController extends ControllerTemplate
{
    protected array $requiredParams = ['userId', 'name', 'minimumMillisecondsIdleTimeAllowed', 'roleKey'];

    public function __construct(
        private CreateGroupUseCase $createGroup
    ) {
    }

    protected function performSpecificOperation(RequestInput $requestInput): RequestOutput
    {
        $requestParams = $requestInput->body;

        $groupData =  $this->createGroup->perform(
            createdByUserId: (int) $requestParams['userId'],
            groupData: new GroupData(
                name: (string) $requestParams['name'],
                minimumMillisecondsIdleTimeAllowed: (int) $requestParams['minimumMillisecondsIdleTimeAllowed'],
                roleKey: (string) $requestParams['roleKey']
            )
        );

        return new RequestOutput(body: (array) $groupData);
    }
}
