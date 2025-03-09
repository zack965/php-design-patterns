<?php
namespace Zack\LaravelDesignPatterns\StructuralDesignPattern\FacadeDesignPattern\Services;

use InvalidArgumentException;
use Zack\LaravelDesignPatterns\StructuralDesignPattern\FacadeDesignPattern\Contracts\FacadePaymentContract;
use Zack\LaravelDesignPatterns\StructuralDesignPattern\FacadeDesignPattern\FacadePaymentMethods\FacadePaypalPaymentMethod;
use Zack\LaravelDesignPatterns\StructuralDesignPattern\FacadeDesignPattern\FacadePaymentMethods\FacadeStripePaymentMethod;

class FacadePaymentService
{
    private FacadePaymentContract $payment;
    public function __construct(string $paymentMethodSelected)
    {
        $this->payment = match ($paymentMethodSelected) {
            "paypal" => new FacadePaypalPaymentMethod(),
            "stripe" => new FacadeStripePaymentMethod(),
            default => throw new InvalidArgumentException("no payment method selected")
        };
    }
    public function pay(): string
    {
        return $this->payment->processPayment();
    }
}