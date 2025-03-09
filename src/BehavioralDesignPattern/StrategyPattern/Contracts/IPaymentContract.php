<?php

namespace Zack\LaravelDesignPatterns\BehavioralDesignPattern\StrategyPattern\Contracts;


interface IPaymentContract
{
    public function processPayment(): string;
}