<?php

declare(strict_types=1);

namespace App\Entities;

class IdleTimeEvent extends ClientApplicationEvent
{
    public function __construct(
        \DateTime $dateTime,
        private int $minimumMillisecondsIdleTimeAllowed
    ) {
        parent::__construct($dateTime);
    }

    public function getMinimumMillisecondsIdleTimeAllowed(): int
    {
        return $this->minimumMillisecondsIdleTimeAllowed;
    }
}
