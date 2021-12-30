<?php

declare(strict_types=1);

namespace App\UseCases\CreateGroup\Exceptions;

use Exception;

class GroupNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Group\'s id not found!');
    }
}
