<?php

declare(strict_types=1);

namespace App\UseCases\CreateUser\Exceptions;

use Exception;

class NotAllowedToCreateUserException extends Exception
{
    public function __construct()
    {
        parent::__construct('User\'s role IS NOT ALLOWED to create a user!');
    }
}
