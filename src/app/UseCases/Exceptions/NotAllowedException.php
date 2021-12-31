<?php

declare(strict_types=1);

namespace App\UseCases\Exceptions;

use App\Exceptions\DomainException;

class NotAllowedException extends DomainException
{
    public function __construct(string $error)
    {
        parent::__construct($error);
    }
}
