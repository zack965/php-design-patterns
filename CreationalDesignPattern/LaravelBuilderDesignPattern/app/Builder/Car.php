<?php

namespace App\Builder;

class Car
{
    public string $model;
    public string $YearOfRelease;
    public int $price;
    public string $Brand;
    public int $topSpeed;

    // Getter for model
    public function getModel(): string
    {
        return $this->model;
    }

    // Getter for YearOfRelease
    public function getYearOfRelease(): string
    {
        return $this->YearOfRelease;
    }

    // Getter for price
    public function getPrice(): int
    {
        return $this->price;
    }

    // Getter for Brand
    public function getBrand(): string
    {
        return $this->Brand;
    }

    // Getter for topSpeed
    public function getTopSpeed(): int
    {
        return $this->topSpeed;
    }
}
