<?php

declare(strict_types=1);

namespace Test\UseCases\CreateGroup;

use PHPUnit\Framework\TestCase;
use Test\Doubles\Repositories\{InMemoryGroupRepository, InMemoryUserRepository};
use Test\Builders\{UserDataBuilder, GroupDataBuilder};
use App\UseCases\CreateGroup\DefaultCase as CreateGroup;
use App\UseCases\Ports\{UserRepository, GroupRepository, GroupData};
use App\UseCases\CreateGroup\Exceptions\{
    NotAllowedToCreateGroupException,
    ExistingGroupException,
    UserNotFoundException,
    GroupNotFoundException
};

final class DefaultCaseTest extends TestCase
{
    public function testCanBeCreatedFromValidData(): void
    {
        $userRepository = $this->getUserRepositoryWithDefaultUser();
        $groupRepository = $this->getGroupRepositoryWithDefaultGroup();

        $createGroup = new CreateGroup($userRepository, $groupRepository);
        $createGroup->perform(
            1,
            new GroupData(
                name: 'New Group Example',
                minimumMillisecondsIdleTimeAllowed: 1000,
                roleKey: 'ADMIN'
            )
        );

        $this->assertEquals(2, $groupRepository->count());
    }

    public function testThrowsExceptionWhenOwnerIdNotFound(): void
    {
        $this->expectException(UserNotFoundException::class);

        $emptyUserRepository = new InMemoryUserRepository();
        $emptyGroupRepository = new InMemoryGroupRepository();

        $createGroup = new CreateGroup($emptyUserRepository, $emptyGroupRepository);
        $createGroup->perform(
            1,
            new GroupData(
                name: 'Group Example',
                minimumMillisecondsIdleTimeAllowed: 1000,
                roleKey: 'ADMIN'
            )
        );
    }

    public function testThrowsExceptionWhenOwnerGroupNotFound(): void
    {
        $this->expectException(GroupNotFoundException::class);

        $userRepository = $this->getUserRepositoryWithDefaultUser();
        $emptyGroupRepository = new InMemoryGroupRepository();

        $createGroup = new CreateGroup($userRepository, $emptyGroupRepository);
        $createGroup->perform(
            1,
            new GroupData(
                name: 'Group Example',
                minimumMillisecondsIdleTimeAllowed: 1000,
                roleKey: 'ADMIN'
            )
        );
    }

    public function testThrowsExceptionWhenOwnerRoleCannotCreateGroup(): void
    {
        $this->expectException(NotAllowedToCreateGroupException::class);

        $groupData = GroupDataBuilder::aGroup()->withClientRole()->build();

        $userRepository = $this->getUserRepositoryWithDefaultUser();
        $groupRepository = new InMemoryGroupRepository([$groupData]);

        $createGroup = new CreateGroup($userRepository, $groupRepository);
        $createGroup->perform(
            1,
            new GroupData(
                name: 'Group Example',
                minimumMillisecondsIdleTimeAllowed: 1000,
                roleKey: 'ADMIN'
            )
        );
    }

    public function testThrowsExceptionWhenGroupNameAlreadyExists(): void
    {
        $this->expectException(ExistingGroupException::class);

        $userRepository = $this->getUserRepositoryWithDefaultUser();
        $groupRepository = $this->getGroupRepositoryWithDefaultGroup();

        $createGroup = new CreateGroup($userRepository, $groupRepository);
        $createGroup->perform(
            1,
            new GroupData(
                name: 'Group Example',
                minimumMillisecondsIdleTimeAllowed: 1000,
                roleKey: 'ADMIN'
            )
        );
    }

    private function getUserRepositoryWithDefaultUser(): UserRepository
    {
        $userData = UserDataBuilder::aUser()->build();

        return new InMemoryUserRepository([$userData]);
    }

    private function getGroupRepositoryWithDefaultGroup(): GroupRepository
    {
        $groupData = GroupDataBuilder::aGroup()->build();

        return new InMemoryGroupRepository([$groupData]);
    }
}
