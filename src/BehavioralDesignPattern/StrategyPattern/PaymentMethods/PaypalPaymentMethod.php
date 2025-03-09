<?php

namespace Zack\LaravelDesignPatterns\BehavioralDesignPattern\StrategyPattern\PaymentMethods;

use Zack\LaravelDesignPatterns\BehavioralDesignPattern\StrategyPattern\Contracts\IPaymentContract;

class PaypalPaymentMethod implements IPaymentContract
{
    public function processPayment(): string
    {
        return "this is a paypal payment method \n";
    }
}