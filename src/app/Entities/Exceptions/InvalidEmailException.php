<?php

declare(strict_types=1);

namespace App\Entities\Exceptions;

class InvalidEmailException extends DomainException
{
    public function __construct(string $email)
    {
        parent::__construct(sprintf('Email "%s" is invalid!', $email));
    }
}
