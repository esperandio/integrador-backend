<?php

declare(strict_types=1);

namespace Test\UseCases\CreateGroup;

use PHPUnit\Framework\TestCase;
use Test\Doubles\Repositories\{InMemoryGroupRepository, InMemoryUserRepository};
use Test\Doubles\UseCases\FakeAuthorization;
use Test\Builders\GroupDataBuilder;
use App\UseCases\CreateGroup\DefaultCase as CreateGroup;
use App\UseCases\Ports\{GroupRepository, GroupData};
use App\UseCases\CreateGroup\Exceptions\{
    NotAllowedToCreateGroupException,
    ExistingGroupException
};

final class DefaultCaseTest extends TestCase
{
    public function testCanBeCreatedFromValidData(): void
    {
        $groupRepository = $this->getGroupRepositoryWithDefaultGroup();

        $createGroup = new CreateGroup(
            new FakeAuthorization(),
            $groupRepository
        );

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

    public function testThrowsExceptionWhenOwnerRoleCannotCreateGroup(): void
    {
        $this->expectException(NotAllowedToCreateGroupException::class);

        $groupData = GroupDataBuilder::aGroup()->withClientRole()->build();

        $groupRepository = new InMemoryGroupRepository([$groupData]);

        $createGroup = new CreateGroup(
            new FakeAuthorization(false),
            $groupRepository
        );

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

        $groupRepository = $this->getGroupRepositoryWithDefaultGroup();

        $createGroup = new CreateGroup(
            new FakeAuthorization(),
            $groupRepository
        );

        $createGroup->perform(
            1,
            new GroupData(
                name: 'Group Example',
                minimumMillisecondsIdleTimeAllowed: 1000,
                roleKey: 'ADMIN'
            )
        );
    }

    private function getGroupRepositoryWithDefaultGroup(): GroupRepository
    {
        $groupData = GroupDataBuilder::aGroup()->build();

        return new InMemoryGroupRepository([$groupData]);
    }
}
