<?php

declare(strict_types=1);

namespace Test\UseCases\CreateUser;

use PHPUnit\Framework\TestCase;
use Test\Doubles\Repositories\{InMemoryGroupRepository, InMemoryUserRepository};
use Test\Doubles\Encoder\FakeEncoder;
use Test\Doubles\UseCases\FakeAuthorization;
use Test\Builders\{UserDataBuilder, GroupDataBuilder};
use App\UseCases\CreateUser\DefaultCase as CreateUser;
use App\UseCases\Ports\{UserRepository, GroupRepository, UserData};
use App\UseCases\CreateUser\Exceptions\{
    NotAllowedToCreateUserException,
    ExistingUserException,
    UserNotFoundException,
    GroupNotFoundException
};

class DefaultCaseTest extends TestCase
{
    public function testCanBeCreatedFromValidData(): void
    {
        $userRepository = $this->getUserRepositoryWithDefaultUser();
        $groupRepository = $this->getGroupRepositoryWithDefaultGroup();
        $encoder = new FakeEncoder();

        $createUser = new CreateUser(new FakeAuthorization(), $userRepository, $groupRepository, $encoder);
        $userData = $createUser->perform(
            createdByUserId: 1,
            userData: new UserData(
                email: 'newuser@example.com',
                password: 'abcABC123',
                groupId: 1
            )
        );

        $this->assertEquals(2, $userRepository->count());
        $this->assertEquals(true, $encoder->verify('abcABC123', $userData->password));
    }

    public function testThrowsExceptionWhenOwnerRoleCannotCreateUser(): void
    {
        $this->expectException(NotAllowedToCreateUserException::class);

        $groupData = GroupDataBuilder::aGroup()->withClientRole()->build();

        $userRepository = $this->getUserRepositoryWithDefaultUser();
        $groupRepository = new InMemoryGroupRepository([$groupData]);

        $createUser = new CreateUser(
            new FakeAuthorization(false),
            $userRepository,
            $groupRepository,
            new FakeEncoder()
        );

        $createUser->perform(
            createdByUserId: 1,
            userData: new UserData(
                email: 'user@example.com',
                password: 'abcABC123',
                groupId: 1
            )
        );
    }

    public function testThrowsExceptionWhenUserEmailAlreadyExists(): void
    {
        $this->expectException(ExistingUserException::class);

        $userRepository = $this->getUserRepositoryWithDefaultUser();
        $groupRepository = $this->getGroupRepositoryWithDefaultGroup();

        $createUser = new CreateUser(new FakeAuthorization(), $userRepository, $groupRepository, new FakeEncoder());
        $createUser->perform(
            createdByUserId: 1,
            userData: new UserData(
                email: 'user@example.com',
                password: 'abcABC123',
                groupId: 1
            )
        );
    }

    public function testThrowsExceptionWhenUserGroupNotFound(): void
    {
        $this->expectException(GroupNotFoundException::class);

        $userRepository = $this->getUserRepositoryWithDefaultUser();
        $groupRepository = $this->getGroupRepositoryWithDefaultGroup();

        $createUser = new CreateUser(new FakeAuthorization(), $userRepository, $groupRepository, new FakeEncoder());
        $createUser->perform(
            createdByUserId: 1,
            userData: new UserData(
                email: 'newuser@example.com',
                password: 'abcABC123',
                groupId: 2
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
