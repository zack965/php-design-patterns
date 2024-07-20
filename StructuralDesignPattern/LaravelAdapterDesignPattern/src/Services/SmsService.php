<?php

namespace Zack\LaravelAdapterDesignPattern\Services;

class SmsService
{
    // Implementation for sending SMS using SMS service
    public function sendSMS($to, $message): string
    {
        return "SMS sent to $to with message '$message'";
    }
}
