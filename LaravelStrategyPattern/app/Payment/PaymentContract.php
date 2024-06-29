<?php

namespace App\Payment;

interface PaymentContract
{
    public function processPayment(): string;
}
