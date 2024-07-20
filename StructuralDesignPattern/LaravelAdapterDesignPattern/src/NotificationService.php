<?php

namespace Zack\LaravelAdapterDesignPattern;

use Zack\LaravelAdapterDesignPattern\Contracts\AppNotificationContract;

class NotificationService
{
    private AppNotificationContract $appNotificationContract;
    public function __construct(AppNotificationContract $appNotificationContract)
    {
        $this->appNotificationContract = $appNotificationContract;
    }
    public function notify(string $message, string $to): string
    {
        return $this->appNotificationContract->sendNotification($message, $to);
    }
}
