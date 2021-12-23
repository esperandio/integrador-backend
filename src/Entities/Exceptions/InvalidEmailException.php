<?php

declare(strict_types=1);

namespace App\Entities\Exceptions;

use Exception;

class InvalidEmailException extends Exception
{
    public function __construct(string $email)
    {
        parent::__construct(sprintf('Email "%s" is invalid!', $email));
    }
}
