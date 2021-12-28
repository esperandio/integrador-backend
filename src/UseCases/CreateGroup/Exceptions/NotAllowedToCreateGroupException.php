<?php

declare(strict_types=1);

namespace App\UseCases\CreateGroup\Exceptions;

use App\UseCases\Exceptions\NotAllowedException;

class NotAllowedToCreateGroupException extends NotAllowedException
{
    public function __construct()
    {
        parent::__construct('User\'s role IS NOT ALLOWED to create a group!');
    }
}
