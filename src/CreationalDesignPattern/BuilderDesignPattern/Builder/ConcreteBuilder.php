<?php

namespace Zack\LaravelDesignPatterns\CreationalDesignPattern\BuilderDesignPattern\Builder;

use Zack\LaravelDesignPatterns\CreationalDesignPattern\BuilderDesignPattern\Contracts\ICarBuilder;

class ConcreteBuilder implements ICarBuilder
{
    private Car $builder;
    public function __construct()
    {
        $this->reset();
    }
    public function buildModel(string $model): ICarBuilder
    {
        $this->builder->model = $model;
        return $this;
    }

    public function buildYearOfRelease(string $YearOfRelease): ICarBuilder
    {
        $this->builder->YearOfRelease = $YearOfRelease;
        return $this;
    }

    public function buildPrice(int $price): ICarBuilder
    {
        $this->builder->price = $price;
        return $this;
    }

    public function buildBrand(string $brand): ICarBuilder
    {
        $this->builder->Brand = $brand;
        return $this;
    }

    public function buildTopSpeed(int $topSpeed): ICarBuilder
    {
        $this->builder->topSpeed = $topSpeed;
        return $this;
    }

    public function getCar(): Car
    {
        return $this->builder;
    }
    public function reset(): void
    {
        $this->builder = new Car();
    }
}