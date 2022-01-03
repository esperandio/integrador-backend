<?php

declare(strict_types=1);

namespace App\Presentation\Middleware\Exceptions;

use App\Exceptions\DomainException;

class UnauthorizedException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Invalid token!');
    }
}
