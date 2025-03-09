<?php
namespace Zack\LaravelDesignPatterns\StructuralDesignPattern\FacadeDesignPattern\FacadePaymentMethods;

use Zack\LaravelDesignPatterns\StructuralDesignPattern\FacadeDesignPattern\Contracts\FacadePaymentContract;

class FacadePaypalPaymentMethod implements FacadePaymentContract
{
    public function processPayment(): string
    {
        return "this is a paypal payment method \n";
    }
}