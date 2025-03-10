<?php

use Zack\LaravelDesignPatterns\CreationalDesignPattern\PrototypeDesignPattern\Address;
use Zack\LaravelDesignPatterns\CreationalDesignPattern\PrototypeDesignPattern\PersonPrototype;

require "vendor/autoload.php";

$originalPerson = new PersonPrototype(name: "John Doe", age: 30, address: new Address(city: "New York", street: "5th Avenue"));

$clonedPerson = clone $originalPerson;

$clonedPerson->setName("Jane Doe");
echo "Original Name: " . $originalPerson->getName() . PHP_EOL;
echo "Original Address: " . $originalPerson->getAddress()->getCity() . PHP_EOL;

echo "Cloned Name: " . $clonedPerson->getName() . PHP_EOL;
echo "Cloned Address: " . $clonedPerson->getAddress()->getCity() . PHP_EOL;