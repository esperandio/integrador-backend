<?php

declare(strict_types=1);

namespace App\Presentation\Controllers\Exceptions;

use Exception;

class MissingParamException extends Exception
{
    /**
     * @param array<string> $missingParams
     */
    public function __construct(array $missingParams)
    {
        parent::__construct('Missing parameter(s): ' . implode(", ", $missingParams));
    }
}
