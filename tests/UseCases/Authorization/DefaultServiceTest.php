<?php

declare(strict_types=1);

namespace Test\UseCases\Authorization;

use PHPUnit\Framework\TestCase;
use Test\Builders\{UserDataBuilder, GroupDataBuilder};
use Test\Doubles\Repositories\{InMemoryGroupRepository, InMemoryUserRepository};
use App\UseCases\Authorization\DefaultService as AuthorizationService;
use App\UseCases\Authorization\Exceptions\{
    UserNotFoundException,
    GroupNotFoundException
};

final class DefaultServiceTest extends TestCase
{
    public function testReturnTrueWhenGroupRoleIsAllowedToPerformOperation(): void
    {
        $authorizationService = new AuthorizationService(
            $this->getUserRepositoryWithDefaultUser(), 
            $this->getGroupRepositoryWithDefaultGroup()
        );

        $this->assertEquals(true, $authorizationService->checkIfUserIsAllowedToPerformOperation(1, 'createGroup'));
    }

    public function testReturnFalseWhenGroupRoleIsNotAllowedToPerformOperation(): void
    {
        $groupData = GroupDataBuilder::aGroup()->withClientRole()->build();

        $authorizationService = new AuthorizationService(
            $this->getUserRepositoryWithDefaultUser(), 
            new InMemoryGroupRepository([$groupData])
        );

        $this->assertEquals(false, $authorizationService->checkIfUserIsAllowedToPerformOperation(1, 'createGroup'));
    }

    public function testThrowsExceptionWhenUserIdNotFound(): void
    {
        $this->expectException(UserNotFoundException::class);

        $authorizationService = new AuthorizationService(
            $this->getUserRepositoryWithDefaultUser(), 
            $this->getGroupRepositoryWithDefaultGroup()
        );

        $authorizationService->checkIfUserIsAllowedToPerformOperation(100, 'createGroup');
    }

    public function testThrowsExceptionWhenGroupIdNotFound(): void
    {
        $this->expectException(GroupNotFoundException::class);

        $userData = UserDataBuilder::aUser()->withDifferentGroupId(100)->build();

        $authorizationService = new AuthorizationService(
            new InMemoryUserRepository([$userData]), 
            $this->getGroupRepositoryWithDefaultGroup()
        );

        $authorizationService->checkIfUserIsAllowedToPerformOperation(1, 'createGroup');
    }

    private function getUserRepositoryWithDefaultUser(): InMemoryUserRepository
    {
        $userData = UserDataBuilder::aUser()->build();

        return new InMemoryUserRepository([$userData]);
    }

    private function getGroupRepositoryWithDefaultGroup(): InMemoryGroupRepository
    {
        $groupData = GroupDataBuilder::aGroup()->build();

        return new InMemoryGroupRepository([$groupData]);
    }
}