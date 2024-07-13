<?php

namespace App\Payment\PaymentMethod;

use App\Payment\PaymentContract;

class PaypalPaymentMethod implements PaymentContract
{
    public function processPayment(): string
    {
        return "this is a paypal payment method";
    }
}
