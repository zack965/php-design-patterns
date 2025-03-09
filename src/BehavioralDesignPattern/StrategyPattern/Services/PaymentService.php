<?php

namespace Zack\LaravelDesignPatterns\BehavioralDesignPattern\StrategyPattern\Services;


use InvalidArgumentException;
use Zack\LaravelDesignPatterns\BehavioralDesignPattern\StrategyPattern\Contracts\IPaymentContract;
use Zack\LaravelDesignPatterns\BehavioralDesignPattern\StrategyPattern\PaymentMethods\PaypalPaymentMethod;
use Zack\LaravelDesignPatterns\BehavioralDesignPattern\StrategyPattern\PaymentMethods\StripePaymentMethod;

class PaymentService
{
    private IPaymentContract $payment;

    public function __construct(string $paymentMethodSelected)
    {
        $this->payment = match ($paymentMethodSelected) {
            "paypal" => new PaypalPaymentMethod(),
            "stripe" => new StripePaymentMethod(),
            default => throw new InvalidArgumentException("no payment method selected")
        };
    }

    public function pay(): string
    {
        return $this->payment->processPayment();
    }
}
