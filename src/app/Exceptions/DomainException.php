<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class DomainException extends Exception
{
    public function __construct(string $error)
    {
        parent::__construct($error);
    }
}
