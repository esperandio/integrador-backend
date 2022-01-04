<?php

declare(strict_types=1);

namespace App\UseCases\Authorization\Exceptions;

use App\Exceptions\DomainException;

class UserNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct('User\'s id not found!');
    }
}
