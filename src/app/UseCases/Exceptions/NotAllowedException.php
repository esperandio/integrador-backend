<?php

declare(strict_types=1);

namespace App\UseCases\Exceptions;

use Exception;

class NotAllowedException extends Exception
{
    public function __construct(string $error)
    {
        parent::__construct($error);
    }
}
