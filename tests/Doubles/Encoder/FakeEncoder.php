<?php

declare(strict_types=1);

namespace Test\Doubles\Encoder;

use App\UseCases\Ports\Encoder;

class FakeEncoder implements Encoder
{
    public function hash(string $password): string
    {
        return $password . 'ENCRYPTED';
    }

    public function verify(string $password, string $hash): bool
    {
        if ($hash == $this->hash($password)) {
            return true;
        }

        return false;
    }
}
