<?php

use Zack\LaravelDesignPatterns\CreationalDesignPattern\BuilderDesignPattern\Builder\ConcreteBuilder;
use Zack\LaravelDesignPatterns\CreationalDesignPattern\BuilderDesignPattern\Builder\PorcheBuilder;

require "vendor/autoload.php";


echo "Command for building car " . "\n";
$builder = new ConcreteBuilder();
$PorcheBuilder = new PorcheBuilder();
$PorcheBuilder->setBuilder($builder);
$PorcheBuilder->buildPorche();
$car = $builder->getCar();
echo "Brand: " . $car->getBrand() . "\n";