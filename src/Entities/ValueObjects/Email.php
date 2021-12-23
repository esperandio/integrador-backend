<?php

declare(strict_types=1);

namespace App\Entities\ValueObjects;

use App\Entities\Exceptions\InvalidEmailException;

class Email
{
    private function __construct(
        private string $value
    ) {
    }

    public static function create(string $email): Email
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException($email);
        }

        return new Email($email);
    }

    public function __toString()
    {
        return $this->value;
    }
}
