<?php

declare(strict_types=1);

namespace Test\Entities\Factories;

use PHPUnit\Framework\TestCase;
use App\UseCases\Factories\ClientApplicationEvent;
use App\UseCases\Factories\Exceptions\EventKeyNotFoundException;
use App\UseCases\Factories\Ports\EventData;
use App\Entities\{
    ExitApplicationEvent,
    IdleTimeEvent,
    StartApplicationEvent,
    StartWatcherEvent,
    StopWatcherEvent
};

class ClientApplicationEventTest extends TestCase
{
    public function testReturnExitApplicationEventInstance(): void
    {
        $this->assertInstanceOf(
            ExitApplicationEvent::class,
            ClientApplicationEvent::create(new EventData(
                key: 'ExitApplicationEvent'
            ))
        );
    }

    public function testReturnIdleTimeEventInstance(): void
    {
        $this->assertInstanceOf(
            IdleTimeEvent::class,
            ClientApplicationEvent::create(new EventData(
                key: 'IdleTimeEvent'
            ))
        );
    }

    public function testReturnStartApplicationEventInstance(): void
    {
        $this->assertInstanceOf(
            StartApplicationEvent::class,
            ClientApplicationEvent::create(new EventData(
                key: 'StartApplicationEvent'
            ))
        );
    }

    public function testReturnStartWatcherEventInstance(): void
    {
        $this->assertInstanceOf(
            StartWatcherEvent::class,
            ClientApplicationEvent::create(new EventData(
                key: 'StartWatcherEvent'
            ))
        );
    }

    public function testReturnStopWatcherEventInstance(): void
    {
        $this->assertInstanceOf(
            StopWatcherEvent::class,
            ClientApplicationEvent::create(new EventData(
                key: 'StopWatcherEvent'
            ))
        );
    }

    public function testThrowsExceptionWhenKeyIsInvalid(): void
    {
        $this->expectException(EventKeyNotFoundException::class);

        ClientApplicationEvent::create(new EventData(
            key: 'invalid'
        ));
    }
}
