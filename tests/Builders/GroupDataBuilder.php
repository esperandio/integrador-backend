<?php

declare(strict_types=1);

namespace Test\Builders;

use App\UseCases\Ports\GroupData;

class GroupDataBuilder
{
    private GroupData $groupData;

    private function __construct()
    {
        $this->groupData = new GroupData(
            name: 'Group Example',
            minimumMillisecondsIdleTimeAllowed: 10000,
            roleKey: 'ADMIN',
            id: 1
        );
    }

    public static function aGroup(): GroupDataBuilder
    {
        return new GroupDataBuilder();
    }

    public function withClientRole(): GroupDataBuilder
    {
        $this->groupData->roleKey = 'CLIENT';
        return $this;
    }

    public function build(): GroupData
    {
        return $this->groupData;
    }
}
