<?php

declare(strict_types=1);

namespace App\UseCases\SignIn\Exceptions;

use App\Exceptions\DomainException;

class WrongPasswordException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Wrong password!');
    }
}
