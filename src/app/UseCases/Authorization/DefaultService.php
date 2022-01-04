<?php

declare(strict_types=1);

namespace App\UseCases\Authorization;

use App\UseCases\Ports\AuthorizationService;
use App\UseCases\Ports\{UserRepository, GroupRepository};
use App\Entities\Factories\Role as RoleFactory;
use App\UseCases\Authorization\Exceptions\{UserNotFoundException, GroupNotFoundException};

class DefaultService implements AuthorizationService
{
    public function __construct(
        private UserRepository $userRepository,
        private GroupRepository $groupRepository
    ) {
    }

    public function checkIfUserIsAllowedToPerformOperation(int $userId, string $operation): bool
    {
        $ownerData = $this->userRepository->findUserById($userId);

        if (empty($ownerData)) {
            throw new UserNotFoundException();
        }

        $ownerGroupData = $this->groupRepository->findGroupById($ownerData->groupId);

        if (empty($ownerGroupData)) {
            throw new GroupNotFoundException();
        }

        $ownerRole = RoleFactory::create($ownerGroupData->roleKey);

        return $ownerRole->getPermissionValueByKey($operation);
    }
}
