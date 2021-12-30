<?php

declare(strict_types=1);

namespace App\UseCases\CreateGroup\Exceptions;

use Exception;

class ExistingGroupException extends Exception
{
    public function __construct()
    {
        parent::__construct('Group with the same name already exists!');
    }
}
