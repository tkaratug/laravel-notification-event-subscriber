<?php

declare(strict_types=1);

namespace Tkaratug\NotificationEventSubscriber\Tests;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class NotificationEventSubscriberTest extends TestCase
{
    /**
     * @test
     */
    public function it_listens_notification_sent_event(): void
    {
        // Assert
        Log::shouldReceive('info')->with('notification has been sent to foo@bar.com')->once();
        Log::shouldReceive('info')->with('notification is being sent to foo@bar.com')->once();

        // Act
        Notification::route('mail', 'foo@bar.com')->notify(new TestNotification());
    }
}

class TestNotification extends \Illuminate\Notifications\Notification
{
    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return new MailMessage;
    }

    public function onSent($notifiable, string $channel, $response = null): void
    {
        $to = $notifiable->routeNotificationFor($channel, $this);
        Log::info('notification has been sent to '.$to);
    }

    public function onSending($notifiable, string $channel): void
    {
        $to = $notifiable->routeNotificationFor($channel, $this);
        Log::info('notification is being sent to '.$to);
    }
}
