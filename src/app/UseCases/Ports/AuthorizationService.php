<?php

declare(strict_types=1);

namespace App\UseCases\Ports;

interface AuthorizationService
{
    public function checkIfUserIsAllowedToPerformOperation(int $userId, string $operation): bool;
}
