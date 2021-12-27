<?php

declare(strict_types=1);

namespace Test\Doubles\UseCases;

use App\UseCases\Ports\{CreateGroupUseCase, GroupData};

class ExceptionCreateGroup implements CreateGroupUseCase
{
    public function perform(int $createdByUserId, GroupData $groupData): GroupData
    {
        throw new \Exception("Error Processing Request");
    }
}
