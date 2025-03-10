<?php

namespace Zack\LaravelDesignPatterns\CreationalDesignPattern\PrototypeDesignPattern;

class PersonPrototype
{
    private string $name;
    private int $age;
    private Address $address;

    public function __construct(string $name, int $age, Address $address)
    {
        $this->name = $name;
        $this->age = $age;
        $this->address = $address;
    }

    public function __clone()
    {

        $this->address = clone $this->address;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }
}