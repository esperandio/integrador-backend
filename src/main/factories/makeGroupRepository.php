<?php

declare(strict_types=1);

use App\UseCases\Ports\GroupRepository;
use App\External\Repositories\PDO\PDOGroupRepository;

function makeGroupRepository(): GroupRepository
{
    return new PDOGroupRepository(makePDOHelper());
}
