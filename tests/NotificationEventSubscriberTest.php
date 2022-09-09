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
        Log::shouldReceive('info')->with('notification has been sent')->once();
        Log::shouldReceive('info')->with('notification is being sent')->once();

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

    public function onSent($channel): void
    {
        Log::info('notification has been sent');
    }

    public function onSending($channel): void
    {
        Log::info('notification is being sent');
    }
}
