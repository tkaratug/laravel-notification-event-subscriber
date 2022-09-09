<?php

namespace Tkaratug\NotificationEventSubscriber\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Tkaratug\NotificationEventSubscriber\NotificationEventSubscriberServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            NotificationEventSubscriberServiceProvider::class,
        ];
    }
}
