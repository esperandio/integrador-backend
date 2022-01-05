<?php

declare(strict_types=1);

namespace App\UseCases\Factories\Exceptions;

use App\Exceptions\DomainException;

class EventKeyNotFoundException extends DomainException
{
    public function __construct(string $eventKey)
    {
        parent::__construct(sprintf('Event\'s key "%s" is invalid!', $eventKey));
    }
}
