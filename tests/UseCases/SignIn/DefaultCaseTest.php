<?php

declare(strict_types=1);

namespace Test\UseCases\SignIn;

use PHPUnit\Framework\TestCase;
use Test\Doubles\Repositories\InMemoryUserRepository;
use Test\Doubles\Encoder\FakeEncoder;
use Test\Doubles\TokenManager\FakeTokenManager;
use Test\Builders\UserDataBuilder;
use App\UseCases\SignIn\DefaultCase as SignIn;
use App\UseCases\Ports\{UserRepository};
use App\UseCases\SignIn\Ports\{AuthenticationParamsData, TokenData};
use App\UseCases\SignIn\Exceptions\{UserNotFoundException, WrongPasswordException};

class DefaultCaseTest extends TestCase
{
    public function testCanBeCreatedFromValidData(): void
    {
        $userRepository = $this->getUserRepositoryWithDefaultUser();
        $tokenManager = new FakeTokenManager();

        $signIn = new SignIn($userRepository, new FakeEncoder(), $tokenManager);
        $authenticationResultData = $signIn->perform(new AuthenticationParamsData(
            email: "user@example.com",
            password: "abcABC123"
        ));

        $this->assertEquals(true, $tokenManager->verify($authenticationResultData->accessToken));
    }

    public function testThrowsExceptionWhenEmailNotFound(): void
    {
        $this->expectException(UserNotFoundException::class);

        $userRepository = $this->getUserRepositoryWithDefaultUser();
        $tokenManager = new FakeTokenManager();

        $signIn = new SignIn($userRepository, new FakeEncoder(), $tokenManager);
        $signIn->perform(new AuthenticationParamsData(
            email: "invalid",
            password: "abcABC123"
        ));
    }


    public function testThrowsExceptionWhenPasswordIsWrong(): void
    {
        $this->expectException(WrongPasswordException::class);

        $userRepository = $this->getUserRepositoryWithDefaultUser();
        $tokenManager = new FakeTokenManager();

        $signIn = new SignIn($userRepository, new FakeEncoder(), $tokenManager);
        $signIn->perform(new AuthenticationParamsData(
            email: "user@example.com",
            password: "invalid"
        ));
    }

    private function getUserRepositoryWithDefaultUser(): UserRepository
    {
        $userData = UserDataBuilder::aUser()
            ->withEncriptedPassword(new FakeEncoder())
            ->build();

        return new InMemoryUserRepository([$userData]);
    }
}
