<?php

declare(strict_types=1);

namespace App\UseCases\CreateGroup\Exceptions;

use App\Exceptions\DomainException;

class ExistingGroupException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Group with the same name already exists!');
    }
}
