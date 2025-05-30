<?php
namespace Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Services;


class EmailService
{
    public function sendEmail($to, $message): string
    {
        // Implementation for sending email using email service
        return "Email sent to $to with message '$message'";
    }
}