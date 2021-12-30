<?php

declare(strict_types=1);

namespace App\UseCases\SignIn\Exceptions;

use Exception;

class WrongPasswordExpection extends Exception
{
    public function __construct()
    {
        parent::__construct('Wrong password!');
    }
}
