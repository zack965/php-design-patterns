<?php

use Zack\LaravelAdapterDesignPattern\Adapters\EmailAdapter;
use Zack\LaravelAdapterDesignPattern\Adapters\SmsAdapter;
use Zack\LaravelAdapterDesignPattern\NotificationService;
use Zack\LaravelAdapterDesignPattern\Services\EmailService;
use Zack\LaravelAdapterDesignPattern\Services\SmsService;

require 'vendor/autoload.php';
// email service usage
$emailService = new EmailService();
$emailAdapter = new EmailAdapter($emailService);
$notificationService = new NotificationService($emailAdapter);
echo $notificationService->notify("alhossnizakaria@gmail.com", "This is an SMS notification.") . "\n";



// sms service usage
$smsService = new SmsService();
$smsAdapter = new SmsAdapter($smsService);
$notificationService = new NotificationService($smsAdapter);
echo $notificationService->notify("This is an email notification.", "1234567890") . "\n";
