<?php

declare(strict_types=1);

use App\External\Repositories\PDO\PDOHelper;

function makePDOHelper(): PDOHelper
{
    return new PDOHelper(
        new \PDO(
            dsn: $_ENV['PDO_DSN'],
            username: $_ENV['PDO_USERNAME'],
            password: $_ENV['PDO_PASSWORD']
        )
    );
}
