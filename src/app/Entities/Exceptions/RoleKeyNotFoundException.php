<?php

declare(strict_types=1);

namespace App\Entities\Exceptions;

use App\Exceptions\DomainException;

class RoleKeyNotFoundException extends DomainException
{
    public function __construct(string $roleKey)
    {
        parent::__construct(sprintf('Role\'s key "%s" is invalid!', $roleKey));
    }
}
