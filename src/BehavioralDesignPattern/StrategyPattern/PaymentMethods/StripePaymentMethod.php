<?php

namespace Zack\LaravelDesignPatterns\BehavioralDesignPattern\StrategyPattern\PaymentMethods;


use Zack\LaravelDesignPatterns\BehavioralDesignPattern\StrategyPattern\Contracts\IPaymentContract;

class StripePaymentMethod implements IPaymentContract
{
    public function processPayment(): string
    {
        return "this is a stripe payment method \n";
    }
}