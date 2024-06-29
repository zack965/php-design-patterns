<?php

namespace App\Payment\PaymentMethod;

use App\Payment\PaymentContract;

class StripePaymentMethod implements PaymentContract
{
    public function processPayment(): string
    {
        return "this is a stripe payment method";
    }
}
