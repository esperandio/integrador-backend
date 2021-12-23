<?php

declare(strict_types=1);

namespace Test\Doubles\Repositories;

use App\UseCases\Ports\{UserRepository, UserData};

class InMemoryUserRepository implements UserRepository
{
    /**
     * @param array<UserData> $users
     */
    public function __construct(private array $users = [])
    {
    }

    public function add(UserData $userData): UserData
    {
        $userData->id = count($this->users) + 1;

        $this->users[] = $userData;

        return new UserData(... [
            'email' => $userData->email,
            'password' => $userData->password,
            'groupId' => $userData->groupId,
            'id' => $userData->id
        ]);
    }

    public function findUserByEmail(string $email): ?UserData
    {
        foreach ($this->users as $user) {
            if ($user->email == $email) {
                return $user;
            }
        }

        return null;
    }

    public function findUserById(int $id): ?UserData
    {
        foreach ($this->users as $user) {
            if ($user->id == $id) {
                return $user;
            }
        }

        return null;
    }

    public function count(): int
    {
        return count($this->users);
    }
}
