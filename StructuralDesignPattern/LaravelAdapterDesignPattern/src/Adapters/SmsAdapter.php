<?php

namespace Zack\LaravelAdapterDesignPattern\Adapters;

use Zack\LaravelAdapterDesignPattern\Contracts\AppNotificationContract;
use Zack\LaravelAdapterDesignPattern\Services\SmsService;

class SmsAdapter implements AppNotificationContract
{
    private $smsService;
    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }
    public function sendNotification($to, $message): string
    {
        return $this->smsService->sendSMS($message, $to);
    }
}
