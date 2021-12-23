<?php

declare(strict_types=1);

namespace App\Entities;

use App\Entities\ValueObjects\{Email, Password};

class User
{
    private function __construct(
        private Email $email,
        private Password $password,
        private Group $group
    ) {
    }

    public static function create(
        string $email,
        string $password,
        Group $group
    ): User {
        return new User(
            email: Email::create($email),
            password: Password::create($password),
            group: $group
        );
    }

    public function getEmail(): Email
    {
        return clone $this->email;
    }

    public function getPassword(): Password
    {
        return clone $this->password;
    }


    public function getGroup(): Group
    {
        return clone $this->group;
    }
}
