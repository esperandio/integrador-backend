<?php

declare(strict_types=1);

namespace App\UseCases\CreateGroup\Exceptions;

use Exception;

class NotAllowedToCreateGroupException extends Exception
{
    public function __construct()
    {
        parent::__construct('User\'s role IS NOT ALLOWED to create a group!');
    }
}
