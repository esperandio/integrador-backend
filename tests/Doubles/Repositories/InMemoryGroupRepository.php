<?php

declare(strict_types=1);

namespace Test\Doubles\Repositories;

use App\UseCases\Ports\{GroupRepository, GroupData};

class InMemoryGroupRepository implements GroupRepository
{
    /**
     * @param array<GroupData> $groups
     */
    public function __construct(private array $groups = [])
    {
    }

    public function add(GroupData $groupData): GroupData
    {
        $groupData->id = count($this->groups) + 1;

        $this->groups[] = $groupData;

        return new GroupData(... [
            'name' => $groupData->name,
            'minimumMillisecondsIdleTimeAllowed' => $groupData->minimumMillisecondsIdleTimeAllowed,
            'roleKey' => $groupData->roleKey,
            'id' => $groupData->id
        ]);
    }

    public function findGroupByName(string $name): ?GroupData
    {
        foreach ($this->groups as $group) {
            if ($group->name == $name) {
                return $group;
            }
        }

        return null;
    }

    public function findGroupById(int $id): ?GroupData
    {
        foreach ($this->groups as $group) {
            if ($group->id == $id) {
                return $group;
            }
        }

        return null;
    }

    public function count(): int
    {
        return count($this->groups);
    }
}
