<?php

declare(strict_types=1);

namespace App\Entities;

abstract class ClientApplicationEvent
{
    public function __construct(
        protected \DateTime $dateTime
    ) {
    }
}
