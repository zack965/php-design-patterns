# Builder Design Pattern in PHP and laravel
this project is an implementation of the Builder Pattern in PHP and laravel using a simple example of building a car .
## Overview
The Builder pattern is a creational design pattern that allows for the step-by-step creation of complex objects. 

## Components of the Builder Pattern
- Product (Car): The  object that we are going to construct.
- Builder Interface (ICarBuilder): Specifies the methods for creating the parts of the Product object.
- Concrete Builder (ConcreteBuilder): Implements the Builder interface and constructs and assembles parts of the Product.
- Director (PorcheBuilder): Constructs the object using the Builder interface.

#### The Car class represents the  object that is being built.
```php
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

```
#### Builder Interface: ICarBuilder
The **ICarBuilder** interface defines the methods required to build the parts of the Car object.


```php
<?php

namespace App\Builder;

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

```
#### Concrete Builder: ConcreteBuilder
The **ConcreteBuilder** class implements the **ICarBuilder** interface and provides the actual implementations for constructing the **Car** parts.
```php
<?php

namespace App\Builder;

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

```
### Director: PorcheBuilder
The **PorcheBuilder** class is responsible for managing the construction process. It specifies the order in which to call the building steps to construct a particular configuration of the **Car**.
```php
<?php

namespace App\Builder\CarBuilders;

use App\Builder\ICarBuilder;

class PorcheBuilder
{

    private $builder;
    public function setBuilder(ICarBuilder $builder)
    {
        $this->builder = $builder;
    }
    public function buildPorche(): ICarBuilder
    {
        $this->builder->buildBrand('Porche');
        $this->builder->buildModel('Cayenne');
        $this->builder->buildYearOfRelease('2021');
        $this->builder->buildPrice(300000);
        $this->builder->buildTopSpeed(210);
        return $this->builder;
    }
}

```
#### Client Code
The client code initializes the builder and director, constructs the **Car** object, and retrieves it.
```php
<?php

namespace App\Console\Commands;

use App\Builder\CarBuilders\PorcheBuilder;
use App\Builder\ConcreteBuilder;
use Illuminate\Console\Command;

class BuildCar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:build-car';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $this->info("Command for building car ");
        $builder = new ConcreteBuilder();
        $PorcheBuilder = new PorcheBuilder();
        $PorcheBuilder->setBuilder($builder);
        $PorcheBuilder->buildPorche();
        $car = $builder->getCar();
        $this->info("Brand: " . $car->getBrand());
    }
}

```

