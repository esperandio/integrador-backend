<?php

declare(strict_types=1);

namespace App\UseCases\SignIn;

use App\UseCases\Ports\{SignInUseCase, UserRepository, Encoder};
use App\UseCases\SignIn\Ports\{AuthenticationParamsData, AuthenticationResultData, TokenData, TokenManager};
use App\UseCases\SignIn\Exceptions\{UserNotFoundException, WrongPasswordExpection};

class DefaultCase implements SignInUseCase
{
    public function __construct(
        private UserRepository $userRepository,
        private Encoder $encoder,
        private TokenManager $tokenManager
    ) {
    }

    public function perform(AuthenticationParamsData $authenticationParamsData): AuthenticationResultData
    {
        $userData = $this->userRepository->findUserByEmail($authenticationParamsData->email);

        if (empty($userData)) {
            throw new UserNotFoundException();
        }

        $passwordMatches = $this->encoder->verify($authenticationParamsData->password, $userData->password);

        if (!$passwordMatches) {
            throw new WrongPasswordExpection();
        }

        $accessToken = $this->tokenManager->sign(new TokenData(id: $userData->id));

        return new AuthenticationResultData(
            accessToken: $accessToken
        );
    }
}
