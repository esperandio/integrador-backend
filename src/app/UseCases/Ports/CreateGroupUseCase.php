<?php

declare(strict_types=1);

namespace App\UseCases\Ports;

interface CreateGroupUseCase
{
    public function perform(int $createdByUserId, GroupData $groupData): GroupData;
}
