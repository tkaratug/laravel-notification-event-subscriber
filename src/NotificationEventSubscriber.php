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
     */
    public function handleNotificationSent(NotificationSent $event): void
    {
        if (method_exists($event->notification, 'onSent')) {
            $event->notification->onSent($event->notifiable, $event->channel, $event->response);
        }
    }

    /**
     * Executes `onSending()` method in the notification.
     */
    public function handleNotificationSending(NotificationSending $event): void
    {
        if (method_exists($event->notification, 'onSending')) {
            $event->notification->onSending($event->notifiable, $event->channel);
        }
    }

    /**
     * The subscriber classes to register.
     */
    public function subscribe(Dispatcher $events): array
    {
        return [
            NotificationSent::class => 'handleNotificationSent',
            NotificationSending::class => 'handleNotificationSending',
        ];
    }
}
