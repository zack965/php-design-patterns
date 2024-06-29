<?php

namespace App\Service;

use App\Payment\PaymentContract;
use App\Payment\PaymentMethod\PaypalPaymentMethod;
use App\Payment\PaymentMethod\StripePaymentMethod;
use InvalidArgumentException;

class PaymentService
{
    private PaymentContract $payment;
    public function __construct(string $paymentMethodSelected)
    {
        $this->payment = match ($paymentMethodSelected) {
            "paypal" => new PaypalPaymentMethod(),
            "stripe" => new StripePaymentMethod(),
            default => throw new  InvalidArgumentException("no payment method selected")
        };
    }
    public function pay(): string
    {
        return $this->payment->processPayment();
    }
}
