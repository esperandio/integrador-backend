<?php

declare(strict_types=1);

use App\External\Repositories\PDO\PDOHelper;

function makePDOHelper(): PDOHelper
{
    return new PDOHelper(new \PDO('sqlite::memory:'));
}
