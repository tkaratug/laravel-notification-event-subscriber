![image](https://banners.beyondco.de/Laravel%20Notification%20Event%20Subscriber.png?theme=light&packageManager=composer+require&packageName=tkaratug%2Flaravel-notification-event-subscriber&pattern=architect&style=style_1&description=&md=1&showWatermark=0&fontSize=100px&images=bell&widths=200&heights=200)

# Laravel Notification Event Subscriber

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tkaratug/laravel-notification-event-subscriber.svg?style=flat-square)](https://packagist.org/packages/tkaratug/laravel-notification-event-subscriber)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/tkaratug/laravel-notification-event-subscriber/run-tests?label=tests)](https://github.com/tkaratug/laravel-notification-event-subscriber/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/tkaratug/laravel-notification-event-subscriber/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/tkaratug/laravel-notification-event-subscriber/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/tkaratug/laravel-notification-event-subscriber.svg?style=flat-square)](https://packagist.org/packages/tkaratug/laravel-notification-event-subscriber)

This package allows you to run any kind of actions while a notification is being sent or after it has been sent using `onSent()` and `onSending()` methods.

It registers an event subscriber `NotificationEventSubscriber` and listens to the `NotificationSent` and `NotificationSending` events of Laravel.
When one of them is fired, the event subscriber runs a defined method according to the event.

## Installation

You can install the package via composer:

```bash
composer require tkaratug/laravel-notification-event-subscriber
```

## Usage

```php
namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;

class UserRegisteredNotification extends Notification
{   
    public function via($notifiable): array
    {
        return ['mail'];
    }
    
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
                    ->greeting('foo')
                    ->line('bar');
    }
    
    public function onSending($notifiable, $channel, $response = null): void
    {
        Log::info($this::class . ' is being sent to  via ' . $channel);
    }
    
    public function onSent($notifiable, $channel): void
    {
        Log::info($this::class . ' has been sent to  via ' . $channel);
    }
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Turan Karatuğ](https://github.com/tkaratug)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
