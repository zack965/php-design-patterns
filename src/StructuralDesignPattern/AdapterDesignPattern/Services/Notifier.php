<?php
namespace Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Services;

use Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Contracts\IAppNotificationContract;

class Notifier
{
    private IAppNotificationContract $appNotificationContract;
    public function __construct(IAppNotificationContract $appNotificationContract)
    {
        $this->appNotificationContract = $appNotificationContract;
    }
    public function notify(string $message, string $to): string
    {
        return $this->appNotificationContract->sendNotification($message, $to);
    }
}