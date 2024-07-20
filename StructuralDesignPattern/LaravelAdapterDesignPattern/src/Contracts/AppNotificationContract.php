<?php

namespace Zack\LaravelAdapterDesignPattern\Contracts;

interface AppNotificationContract
{
    public function sendNotification($to, $message): string;
}
