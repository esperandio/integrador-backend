<?php

declare(strict_types=1);

namespace App\External\Repositories\PDO\Ports;

class PDOUserData implements PDOResultData
{
    public function __construct(
        public string $id = "",
        public string $ds_email = "",
        public string $ds_password = "",
        public string $group_id = ""
    ) {
    }
}
