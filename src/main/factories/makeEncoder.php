<?php

declare(strict_types=1);

use App\UseCases\Ports\Encoder;
use App\External\Encoder\BcryptEncoder;

function makeEncoder(): Encoder
{
    return new BcryptEncoder();
}
