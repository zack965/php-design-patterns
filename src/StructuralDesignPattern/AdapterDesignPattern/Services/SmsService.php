<?php
namespace Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Services;

class SmsService
{
    public function sendSMS($to, $message): string
    {
        return "SMS sent to $to with message '$message'";
    }
}