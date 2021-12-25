<?php

declare(strict_types=1);

namespace Test\External\Repositories\PDO;

use PHPUnit\Framework\TestCase;
use Test\Builders\{PDOHelperBuilder, GroupDataBuilder};
use App\External\Repositories\PDO\PDOGroupRepository;
use App\UseCases\Ports\GroupData;

class PDOGroupRepositoryTest extends TestCase
{
    public function testAdd(): void
    {
        $groupRepository = new PDOGroupRepository(PDOHelperBuilder::aHelper()->withGroupsTable()->build());
        $groupData = $groupRepository->add(GroupDataBuilder::aGroup()->build());

        $this->assertEquals(1, $groupData->id);
        $this->assertEquals(1, $groupRepository->count());
    }

    public function testFindGroupByName(): void
    {
        $groupRepository = new PDOGroupRepository(PDOHelperBuilder::aHelper()->withGroupsTable()->build());
        $groupData = $groupRepository->add(GroupDataBuilder::aGroup()->build());

        $this->assertInstanceOf(GroupData::class, $groupRepository->findGroupByName($groupData->name));
    }

    public function testFindGroupById(): void
    {
        $groupRepository = new PDOGroupRepository(PDOHelperBuilder::aHelper()->withGroupsTable()->build());
        $groupData = $groupRepository->add(GroupDataBuilder::aGroup()->build());

        $this->assertInstanceOf(GroupData::class, $groupRepository->findGroupById($groupData->id));
    }

    public function testCount(): void
    {
        $groupRepository = new PDOGroupRepository(PDOHelperBuilder::aHelper()->withGroupsTable()->build());
        $groupData = $groupRepository->add(GroupDataBuilder::aGroup()->build());

        $this->assertEquals(1, $groupRepository->count());
    }
}
