<?php

declare(strict_types=1);

namespace App\UseCases\SignIn\Ports;

class TokenData
{
    public function __construct(
        public int $id = 0
    ) {
    }
}
