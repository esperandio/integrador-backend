<?php

declare(strict_types=1);

namespace App\External\Repositories\PDO;

use App\External\Repositories\PDO\Ports\PDOUserData;
use App\UseCases\Ports\{UserRepository, UserData};

class PDOUserRepository implements UserRepository
{
    public function __construct(
        private PDOHelper $helper
    ) {
    }

    public function add(UserData $userData): UserData
    {
        $this->helper->command(
            'INSERT INTO users (ds_email, ds_password, group_id) VALUES (:ds_email, :ds_password, :group_id)',
            [
                'ds_email' => $userData->email,
                'ds_password' => $userData->password,
                'group_id' => $userData->groupId
            ]
        );

        $userDataCreated = $this->findUserByEmail($userData->email);

        if (empty($userDataCreated)) {
            throw new \Exception("Error Processing Request");
        }

        return $userDataCreated;
    }

    public function findUserByEmail(string $email): ?UserData
    {
        $result = $this->helper->fetchResultDataInstance(
            PDOUserData::class,
            'SELECT * FROM users WHERE ds_email = :ds_email',
            [
                'ds_email' => $email
            ]
        );

        if (empty($result)) {
            return null;
        }

        /**
         * @var PDOUserData $result
         */
        return $this->convertToUserData($result);
    }

    public function findUserById(int $id): ?UserData
    {
        $result = $this->helper->fetchResultDataInstance(
            PDOUserData::class,
            'SELECT * FROM users WHERE id = :id',
            [
                'id' => $id
            ]
        );

        if (empty($result)) {
            return null;
        }

        /**
         * @var PDOUserData $result
         */
        return $this->convertToUserData($result);
    }

    public function count(): int
    {
        return $this->helper->tableRowsCount('users');
    }

    private function convertToUserData(PDOUserData $pdoUserData): UserData
    {
        return new UserData(
            email: $pdoUserData->ds_email,
            password: $pdoUserData->ds_password,
            groupId: (int) $pdoUserData->group_id,
            id: (int) $pdoUserData->id
        );
    }
}
