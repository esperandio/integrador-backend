<?php

declare(strict_types=1);

namespace Test\Doubles\UseCases;

use App\UseCases\Ports\AuthorizationService;

class FakeAuthorization implements AuthorizationService
{
    public function __construct(
        private bool $allowedToPerformOperation = true
    ) {
    }

    public function checkIfUserIsAllowedToPerformOperation(int $userId, string $operation): bool
    {
        return $this->allowedToPerformOperation;
    }
}
