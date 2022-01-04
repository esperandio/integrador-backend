<?php

declare(strict_types=1);

namespace App\UseCases\CreateGroup;

use App\UseCases\Ports\{CreateGroupUseCase, UserRepository, GroupRepository, GroupData};
use App\Entities\Factories\Role as RoleFactory;
use App\Entities\Group;
use App\UseCases\CreateGroup\Exceptions\
{
    NotAllowedToCreateGroupException,
    ExistingGroupException,
    UserNotFoundException,
    GroupNotFoundException
};

class DefaultCase implements CreateGroupUseCase
{
    public function __construct(
        private UserRepository $userRepository,
        private GroupRepository $groupRepository
    ) {
    }

    public function perform(int $createdByUserId, GroupData $groupData): GroupData
    {
        if ($this->userIsNotAllowedToCreateGroup($createdByUserId)) {
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

    private function userIsNotAllowedToCreateGroup(int $createdByUserId): bool
    {
        $ownerData = $this->userRepository->findUserById($createdByUserId);

        if (empty($ownerData)) {
            throw new UserNotFoundException();
        }

        $ownerGroupData = $this->groupRepository->findGroupById($ownerData->groupId);

        if (empty($ownerGroupData)) {
            throw new GroupNotFoundException();
        }

        $ownerRole = RoleFactory::create($ownerGroupData->roleKey);

        if (!$ownerRole->getPermissionValueByKey('createGroup')) {
            return true;
        }

        return false;
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
