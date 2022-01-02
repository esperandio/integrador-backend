<?php

declare(strict_types=1);

namespace App\External\Repositories\PDO;

use App\External\Repositories\PDO\Ports\PDOGroupData;
use App\UseCases\Ports\{GroupRepository, GroupData};

class PDOGroupRepository implements GroupRepository
{
    public function __construct(
        private PDOHelper $helper
    ) {
    }

    public function add(GroupData $groupData): GroupData
    {
        $this->helper->command(
            'INSERT INTO `groups` (nm_group, nr_milliseconds_idle_time, ds_role_key) '
            . 'VALUES (:nm_group, :nr_milliseconds_idle_time, :ds_role_key)',
            [
                'nm_group' => $groupData->name,
                'nr_milliseconds_idle_time' => $groupData->minimumMillisecondsIdleTimeAllowed,
                'ds_role_key' => $groupData->roleKey
            ]
        );

        $groupDataCreated = $this->findGroupByName($groupData->name);

        if (empty($groupDataCreated)) {
            throw new \Exception("Error Processing Request");
        }

        return $groupDataCreated;
    }

    public function findGroupByName(string $name): ?GroupData
    {
        $pdoGroupData = $this->helper->fetchResultDataInstance(
            PDOGroupData::class,
            'SELECT * FROM `groups` WHERE nm_group = :nm_group',
            [
                'nm_group' => $name
            ]
        );

        if (empty($pdoGroupData)) {
            return null;
        }

        /**
         * @var PDOGroupData $pdoGroupData
         */
        return $this->convertToGroupData($pdoGroupData);
    }

    public function findGroupById(int $id): ?GroupData
    {
        $pdoGroupData = $this->helper->fetchResultDataInstance(
            PDOGroupData::class,
            'SELECT * FROM `groups` WHERE id = :id',
            [
                'id' => $id
            ]
        );

        if (empty($pdoGroupData)) {
            return null;
        }

        /**
         * @var PDOGroupData $pdoGroupData
         */
        return $this->convertToGroupData($pdoGroupData);
    }

    public function count(): int
    {
        return $this->helper->tableRowsCount('groups');
    }

    private function convertToGroupData(PDOGroupData $pdoGroupData): GroupData
    {
        return new GroupData(
            name: $pdoGroupData->nm_group,
            minimumMillisecondsIdleTimeAllowed: (int) $pdoGroupData->nr_milliseconds_idle_time,
            roleKey: $pdoGroupData->ds_role_key,
            id: (int) $pdoGroupData->id
        );
    }
}
