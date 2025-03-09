<?php
namespace Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Adapters;

use Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Contracts\IAppNotificationContract;
use Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Services\EmailService;

class EmailAdapter implements IAppNotificationContract
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