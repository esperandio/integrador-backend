<?php

declare(strict_types=1);

namespace App\UseCases\CreateGroup;

use App\UseCases\Ports\{
    CreateGroupUseCase,
    AuthorizationService,
    GroupRepository,
    GroupData
};
use App\UseCases\Factories\Role as RoleFactory;
use App\Entities\Group;
use App\UseCases\CreateGroup\Exceptions\
{
    NotAllowedToCreateGroupException,
    ExistingGroupException
};

class DefaultCase implements CreateGroupUseCase
{
    public function __construct(
        private AuthorizationService $authorizationService,
        private GroupRepository $groupRepository
    ) {
    }

    public function perform(int $createdByUserId, GroupData $groupData): GroupData
    {
        if (!$this->authorizationService->checkIfUserIsAllowedToPerformOperation($createdByUserId, 'createGroup')) {
            throw new NotAllowedToCreateGroupException();
        }

        if ($this->groupAlreadyExists($groupData->name)) {
            throw new ExistingGroupException();
        }

        $group = Group::create(
            name: $groupData->name,
            minimumMillisecondsIdleTimeAllowed: $groupData->minimumMillisecondsIdleTimeAllowed,
            role: RoleFactory::create($groupData->roleKey)
        );

        return $this->groupRepository->add(
            new GroupData(
                name: $group->getName(),
                minimumMillisecondsIdleTimeAllowed: $group->getMinimumMillisecondsIdleTimeAllowed(),
                roleKey: $group->getRole()->getValue()
            )
        );
    }

    private function groupAlreadyExists(string $groupName): bool
    {
        $groups = $this->groupRepository->findGroupByName($groupName);

        if (empty($groups)) {
            return false;
        }

        return true;
    }
}
