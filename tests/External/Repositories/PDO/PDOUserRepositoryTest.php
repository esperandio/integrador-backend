<?php

declare(strict_types=1);

namespace Test\External\Repositories\PDO;

use PHPUnit\Framework\TestCase;
use Test\Builders\{PDOHelperBuilder, UserDataBuilder};
use App\External\Repositories\PDO\PDOUserRepository;
use App\UseCases\Ports\UserData;

class UserRepositoryTest extends TestCase
{
    public function testAdd(): void
    {
        $userRepository = new PDOUserRepository(PDOHelperBuilder::aHelper()->withUsersTable()->build());
        $userData = $userRepository->add(UserDataBuilder::aUser()->build());

        $this->assertEquals(1, $userData->id);
        $this->assertEquals(1, $userRepository->count());
    }

    public function testFindUserByEmail(): void
    {
        $userRepository = new PDOUserRepository(PDOHelperBuilder::aHelper()->withUsersTable()->build());
        $userData = $userRepository->add(UserDataBuilder::aUser()->build());

        $this->assertInstanceOf(UserData::class, $userRepository->findUserByEmail($userData->email));
    }

    public function testFindUserById(): void
    {
        $userRepository = new PDOUserRepository(PDOHelperBuilder::aHelper()->withUsersTable()->build());
        $userData = $userRepository->add(UserDataBuilder::aUser()->build());

        $this->assertInstanceOf(UserData::class, $userRepository->findUserById($userData->id));
    }

    public function testCount(): void
    {
        $userRepository = new PDOUserRepository(PDOHelperBuilder::aHelper()->withUsersTable()->build());
        $userRepository->add(UserDataBuilder::aUser()->build());

        $this->assertEquals(1, $userRepository->count());
    }
}
