<?php

declare(strict_types=1);

namespace App\UseCases\CreateUser;

use App\UseCases\Ports\{
    CreateUserUseCase,
    AuthorizationService,
    UserRepository,
    GroupRepository,
    Encoder,
    UserData
};
use App\Entities\{Group, User};
use App\UseCases\Factories\Role as RoleFactory;
use App\UseCases\CreateUser\Exceptions\{
    ExistingUserException,
    NotAllowedToCreateUserException,
    GroupNotFoundException
};

class DefaultCase implements CreateUserUseCase
{
    public function __construct(
        private AuthorizationService $authorizationService,
        private UserRepository $userRepository,
        private GroupRepository $groupRepository,
        private Encoder $encoder
    ) {
    }

    public function perform(int $createdByUserId, UserData $userData): UserData
    {
        if (!$this->authorizationService->checkIfUserIsAllowedToPerformOperation($createdByUserId, 'createUser')) {
            throw new NotAllowedToCreateUserException();
        }

        if ($this->userAlreadyExists($userData->email)) {
            throw new ExistingUserException();
        }

        $user = User::create(
            email: $userData->email,
            password: $userData->password,
            group: $this->getGroupEntity($userData->groupId)
        );

        return $this->userRepository->add(
            new UserData(
                email: $user->getEmail()->__toString(),
                password: $this->encoder->hash($user->getPassword()->__toString()),
                groupId: $userData->groupId
            )
        );
    }

    private function userAlreadyExists(string $email): bool
    {
        $userExists = $this->userRepository->findUserByEmail($email);

        if (empty($userExists)) {
            return false;
        }

        return true;
    }

    private function getGroupEntity(int $groupId): Group
    {
        $groupData = $this->groupRepository->findGroupById($groupId);

        if (empty($groupData)) {
            throw new GroupNotFoundException();
        }

        return Group::create(
            name: $groupData->name,
            minimumMillisecondsIdleTimeAllowed: $groupData->minimumMillisecondsIdleTimeAllowed,
            role: RoleFactory::create($groupData->roleKey)
        );
    }
}
