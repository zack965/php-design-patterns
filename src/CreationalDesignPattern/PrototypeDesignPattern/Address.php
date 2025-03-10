<?php

namespace Zack\LaravelDesignPatterns\CreationalDesignPattern\PrototypeDesignPattern;



class Address
{

    private string $city;
    private string $street;

    public function __construct(string $city, string $street)
    {
        $this->city = $city;
        $this->street = $street;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getCity(): string
    {
        return $this->city;
    }


    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet($street): void
    {
        $this->street = $street;
    }
}