<?php


require "vendor/autoload.php";
use Zack\LaravelDesignPatterns\StructuralDesignPattern\FacadeDesignPattern\Services\FacadePaymentService;


$paymentMethodStripe = "stripe";
$paymentServiceService = new FacadePaymentService(paymentMethodSelected: $paymentMethodStripe);
echo $paymentServiceService->pay();
$paymentMethodapaypal = "paypal";
$PaypalPaymentService = new FacadePaymentService(paymentMethodSelected: $paymentMethodapaypal);
echo $PaypalPaymentService->pay();
/* $InvalidPaymentMethod = "invalid";
$InvalidPaymentMethodService = new FacadePaymentService($InvalidPaymentMethod);
echo $InvalidPaymentMethodService->pay(); */