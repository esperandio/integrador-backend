<?php

declare(strict_types=1);

namespace App\External\Repositories\PDO\Ports;

class PDOGroupData implements PDOResultData
{
    public function __construct(
        public string $id = "",
        public string $nm_group = "",
        public string $nr_milliseconds_idle_time = "",
        public string $ds_role_key = ""
    ) {
    }
}
