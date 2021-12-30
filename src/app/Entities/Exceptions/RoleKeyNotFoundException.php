<?php

declare(strict_types=1);

namespace App\Entities\Exceptions;

use Exception;

class RoleKeyNotFoundException extends Exception
{
    public function __construct(string $roleKey)
    {
        parent::__construct(sprintf('Role\'s key "%s" is invalid!', $roleKey));
    }
}
