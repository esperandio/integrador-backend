<?php

declare(strict_types=1);

namespace App\UseCases\SignIn\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('User\'s email not found!');
    }
}
