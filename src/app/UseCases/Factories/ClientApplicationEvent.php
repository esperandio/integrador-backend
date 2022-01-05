<?php

declare(strict_types=1);

namespace App\UseCases\Factories;

use App\Entities\{
    ClientApplicationEvent as ClientApplicationEventInterface,
    ExitApplicationEvent,
    IdleTimeEvent,
    StartApplicationEvent,
    StartWatcherEvent,
    StopWatcherEvent
};
use App\UseCases\Factories\Exceptions\EventKeyNotFoundException;
use App\UseCases\Factories\Ports\EventData;
use DateTime;

class ClientApplicationEvent
{
    public static function create(EventData $eventData): ClientApplicationEventInterface
    {
        $dateTime = new DateTime($eventData->dateTime);

        switch ($eventData->key) {
            case 'ExitApplicationEvent':
                return new ExitApplicationEvent($dateTime);
            case 'IdleTimeEvent':
                return new IdleTimeEvent($dateTime, $eventData->minimumMillisecondsIdleTimeAllowed);
            case 'StartApplicationEvent':
                return new StartApplicationEvent($dateTime);
            case 'StartWatcherEvent':
                return new StartWatcherEvent($dateTime);
            case 'StopWatcherEvent':
                return new StopWatcherEvent($dateTime);
        }

        throw new EventKeyNotFoundException($eventData->key);
    }
}
