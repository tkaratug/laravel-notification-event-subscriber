<?php

declare(strict_types=1);

namespace Tkaratug\NotificationEventSubscriber;

use Illuminate\Events\Dispatcher;
use Illuminate\Notifications\Events\NotificationSending;
use Illuminate\Notifications\Events\NotificationSent;

class NotificationEventSubscriber
{
    /**
     * Executes `onSent()` method in the notication.
     *
     * @param  \Illuminate\Notifications\Events\NotificationSent  $event
     * @return void
     */
    public function handleNotificationSent(NotificationSent $event): void
    {
        if (method_exists($event->notification, 'onSent')) {
            $event->notification->onSent($event->channel, $event->response);
        }
    }

    /**
     * Executes `onSending()` method in the notification.
     *
     * @param  \Illuminate\Notifications\Events\NotificationSending  $event
     * @return void
     */
    public function handleNotificationSending(NotificationSending $event): void
    {
        if (method_exists($event->notification, 'onSending')) {
            $event->notification->onSending($event->channel);
        }
    }

    /**
     * The subscriber classes to register.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe(Dispatcher $events): array
    {
        return [
            NotificationSent::class => 'handleNotificationSent',
            NotificationSending::class => 'handleNotificationSending',
        ];
    }
}
