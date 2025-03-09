<?php

use Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Adapters\EmailAdapter;
use Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Adapters\SmsAdapter;
use Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Services\EmailService;
use Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Services\Notifier;
use Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Services\SmsService;

require 'vendor/autoload.php';


// email service usage
$emailService = new EmailService();
$emailAdapter = new EmailAdapter($emailService);
$notificationService = new Notifier($emailAdapter);
echo $notificationService->notify("alhossnizakaria@gmail.com", "This is an Email notification.") . "\n";



// sms service usage
$smsService = new SmsService();
$smsAdapter = new SmsAdapter($smsService);
$notificationService = new Notifier($smsAdapter);
echo $notificationService->notify("This is an SMS notification.", "1234567890") . "\n";