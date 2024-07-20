# Adapter Design Pattern Implementation in PHP
## Overview

This project demonstrates the Adapter Design Pattern in PHP for a notification system. The Adapter Design Pattern allows different notification services (such as email and SMS) to be used interchangeably by providing a common interface.

## Code Structure

### Services
1. EmailService : Handles sending email notifications.

```php
// src/Services/EmailService.php
namespace Zack\LaravelAdapterDesignPattern\Services;

class EmailService
{
    public function sendEmail($to, $message): string
    {
        // Implementation for sending email using email service
        return "Email sent to $to with message '$message'";
    }
}

```
2. SmsService : Handles sending SMS notifications
```php 
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
```
###  Adapters
1. EmailAdapter : Adapts EmailService to the AppNotificationContract interface.
```php
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
```
2. SmsAdapter : Adapts SmsService to the AppNotificationContract interface.
```php
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
```
### Contract
1. AppNotificationContract : Defines a common interface for sending notifications.

```php
<?php

namespace Zack\LaravelAdapterDesignPattern\Contracts;

interface AppNotificationContract
{
    public function sendNotification($to, $message): string;
}
```
### Main Service
1. NotificationService : Uses an adapter to send notifications, ensuring decoupling from specific service implementations.

```php
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
```
### Usage example 
```php
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
```
### Design Explanation
1. Services: EmailService and SmsService handle the specific implementations for sending notifications.
2. Adapters: EmailAdapter and SmsAdapter adapt the service methods to a common interface AppNotificationContract.
3. Contract: AppNotificationContract ensures a unified method for sending notifications across different notifications.
4. Main Service: NotificationService utilizes adapters to decouple notification sending logic from specific implementations.