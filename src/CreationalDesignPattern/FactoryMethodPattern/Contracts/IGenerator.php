<?php

namespace Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Contracts;
interface IGenerator
{
    public function generate(): string;
}
