<?php
namespace Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Contracts;


interface IAppNotificationContract
{
    public function sendNotification($to, $message): string;
}