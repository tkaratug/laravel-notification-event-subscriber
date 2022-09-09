<?php

declare(strict_types=1);

namespace Tkaratug\NotificationEventSubscriber;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class NotificationEventSubscriberServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Event::subscribe(NotificationEventSubscriber::class);
    }
}
