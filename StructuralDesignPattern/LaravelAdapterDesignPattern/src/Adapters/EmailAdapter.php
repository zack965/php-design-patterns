<?php

namespace Zack\LaravelAdapterDesignPattern\Adapters;

use Zack\LaravelAdapterDesignPattern\Contracts\AppNotificationContract;
use Zack\LaravelAdapterDesignPattern\Services\EmailService;

class EmailAdapter implements AppNotificationContract
{
    private $emailService;
    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }
    public function sendNotification($to, $message): string
    {
        return $this->emailService->sendEmail($to, $message);
    }
}
