<?php

namespace Zack\LaravelDesignPatterns\CreationalDesignPattern\BuilderDesignPattern\Contracts;

use Zack\LaravelDesignPatterns\CreationalDesignPattern\BuilderDesignPattern\Builder\Car;


interface ICarBuilder
{
    public function buildModel(string $model): ICarBuilder;

    public function buildYearOfRelease(string $YearOfRelease): ICarBuilder;

    public function buildPrice(int $price): ICarBuilder;

    public function buildBrand(string $brand): ICarBuilder;

    public function buildTopSpeed(int $topSpeed): ICarBuilder;

    public function getCar(): Car;
    public function reset(): void;
}