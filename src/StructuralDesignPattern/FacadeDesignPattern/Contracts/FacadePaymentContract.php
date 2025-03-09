<?php
namespace Zack\LaravelDesignPatterns\StructuralDesignPattern\FacadeDesignPattern\Contracts;

interface FacadePaymentContract
{
    public function processPayment(): string;
}