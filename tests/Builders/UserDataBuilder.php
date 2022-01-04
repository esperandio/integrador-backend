<?php

declare(strict_types=1);

namespace Test\Builders;

use App\UseCases\Ports\UserData;
use App\UseCases\Ports\Encoder;

class UserDataBuilder
{
    private UserData $userData;

    private function __construct()
    {
        $this->userData = new UserData(
            email: 'user@example.com',
            password: 'abcABC123',
            groupId: 1,
            id: 1
        );
    }

    public static function aUser(): UserDataBuilder
    {
        return new UserDataBuilder();
    }

    public function withEncriptedPassword(Encoder $encoder): UserDataBuilder
    {
        $this->userData->password = $encoder->hash($this->userData->password);
        return $this;
    }

    public function withDifferentGroupId(int $groupId): UserDataBuilder
    {
        $this->userData->groupId = $groupId;
        return $this;
    }

    public function build(): UserData
    {
        return $this->userData;
    }
}
