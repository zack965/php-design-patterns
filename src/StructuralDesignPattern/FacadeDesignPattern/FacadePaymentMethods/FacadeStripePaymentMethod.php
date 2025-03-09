<?php
namespace Zack\LaravelDesignPatterns\StructuralDesignPattern\FacadeDesignPattern\FacadePaymentMethods;

use Zack\LaravelDesignPatterns\StructuralDesignPattern\FacadeDesignPattern\Contracts\FacadePaymentContract;

class FacadeStripePaymentMethod implements FacadePaymentContract
{
    public function processPayment(): string
    {
        return "this is a stripe payment method \n";
    }
}