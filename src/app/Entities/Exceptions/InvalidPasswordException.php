<?php

declare(strict_types=1);

namespace App\Entities\Exceptions;

use App\Exceptions\DomainException;

class InvalidPasswordException extends DomainException
{
    public function __construct(string $pattern)
    {
        parent::__construct('Invalid password! Password MUST match the following pattern: ' . $pattern);
    }
}
