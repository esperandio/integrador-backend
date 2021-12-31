<?php

declare(strict_types=1);

use App\UseCases\Ports\UserRepository;
use App\External\Repositories\PDO\PDOUserRepository;

function makeUserRepository(): UserRepository
{
    return new PDOUserRepository(makePDOHelper());
}
