<?php

declare(strict_types=1);

namespace App\Entities;

class ClientRole extends Role
{
    public function getValue(): string
    {
        return "CLIENT";
    }
}
