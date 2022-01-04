<?php

declare(strict_types=1);

namespace App\UseCases\Authorization\Exceptions;

use App\Exceptions\DomainException;

class GroupNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Group\'s id not found!');
    }
}
