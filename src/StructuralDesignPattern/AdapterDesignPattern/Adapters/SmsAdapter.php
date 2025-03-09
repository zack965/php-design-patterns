<?php
namespace Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Adapters;

use Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Contracts\IAppNotificationContract;
use Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Services\SmsService;

class SmsAdapter implements IAppNotificationContract
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