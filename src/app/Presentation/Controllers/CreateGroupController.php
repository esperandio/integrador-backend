<?php

declare(strict_types=1);

namespace App\Presentation\Controllers;

use App\Presentation\Ports\{RequestInput, RequestOutput};
use App\Presentation\Controllers\Ports\{CreateResourceOperation, ControllerTemplate};
use App\UseCases\Ports\{CreateGroupUseCase, GroupData};

class CreateGroupController extends ControllerTemplate implements CreateResourceOperation
{
    protected array $requiredParams = ['userId', 'name', 'minimumMillisecondsIdleTimeAllowed', 'roleKey'];

    public function __construct(
        private CreateGroupUseCase $createGroup
    ) {
    }

    protected function performSpecificOperation(RequestInput $requestInput): RequestOutput
    {
        $groupData =  $this->createGroup->perform(
            createdByUserId: $requestInput->getInt('userId'),
            groupData: new GroupData(
                name: $requestInput->getString('name'),
                minimumMillisecondsIdleTimeAllowed: $requestInput->getInt('minimumMillisecondsIdleTimeAllowed'),
                roleKey: $requestInput->getString('roleKey')
            )
        );

        return new RequestOutput(body: (array) $groupData);
    }
}
