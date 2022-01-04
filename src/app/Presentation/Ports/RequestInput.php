<?php

declare(strict_types=1);

namespace App\Presentation\Ports;

class RequestInput
{
    /**
     * @param array<string, mixed> $body
     */
    public function __construct(
        public array $body = []
    ) {
    }

    public function getInt(string $key): int
    {
        if (
            !array_key_exists($key, $this->body)
            || !is_numeric($this->body[$key])
        ) {
            return 0;
        }

        return (int) $this->body[$key];
    }

    public function getString(string $key): string
    {
        if (
            !array_key_exists($key, $this->body)
            || !is_string($this->body[$key])
        ) {
            return "";
        }

        return (string) $this->body[$key];
    }
}
