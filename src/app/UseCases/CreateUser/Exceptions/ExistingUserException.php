<?php

declare(strict_types=1);

namespace App\UseCases\CreateUser\Exceptions;

use App\Exceptions\DomainException;

class ExistingUserException extends DomainException
{
    public function __construct()
    {
        parent::__construct('User with the same e-mail already exists!');
    }
}
