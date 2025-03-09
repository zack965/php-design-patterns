<?php

require 'vendor/autoload.php';
use Zack\LaravelDesignPatterns\BehavioralDesignPattern\StrategyPattern\Services\PaymentService;
$paymentMethodStripe = "stripe";
$paymentServiceService = new PaymentService($paymentMethodStripe);

echo $paymentServiceService->pay();
$paymentMethodapaypal = "paypal";
$PaypalPaymentService = new PaymentService($paymentMethodapaypal);
echo $PaypalPaymentService->pay();


// this will llunch an exception
$InvalidPaymentMethod = "invalid";
$InvalidPaymentMethodService = new PaymentService($InvalidPaymentMethod);
echo $InvalidPaymentMethodService->pay();
