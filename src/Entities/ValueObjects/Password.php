<?php

declare(strict_types=1);

namespace App\Entities\ValueObjects;

use App\Entities\Exceptions\InvalidPasswordException;

class Password
{
    public const PASSWORD_VALIDATION_REGEX = '/^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,}$/';

    private function __construct(
        private string $value
    ) {
    }

    public static function create(string $password): Password
    {
        if (!preg_match(self::PASSWORD_VALIDATION_REGEX, $password)) {
            throw new InvalidPasswordException(self::PASSWORD_VALIDATION_REGEX);
        }

        return new Password($password);
    }

    public function __toString()
    {
        return $this->value;
    }
}
