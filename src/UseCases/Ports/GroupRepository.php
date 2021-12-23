<?php

declare(strict_types=1);

namespace App\UseCases\Ports;

interface GroupRepository
{
    public function add(GroupData $groupData): GroupData;
    public function findGroupByName(string $name): ?GroupData;
    public function findGroupById(int $id): ?GroupData;
    public function count(): int;
}
