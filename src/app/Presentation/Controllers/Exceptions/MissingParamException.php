<?php

declare(strict_types=1);

namespace App\Presentation\Controllers\Exceptions;

use App\Exceptions\DomainException;

class MissingParamException extends DomainException
{
    /**
     * @param array<string> $missingParams
     */
    public function __construct(array $missingParams)
    {
        parent::__construct('Missing parameter(s): ' . implode(", ", $missingParams));
    }
}
