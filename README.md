# Strategy Pattern in Laravel

## Definition

This repository demonstrates the implementation of the Strategy design pattern in a Laravel application.

The Strategy pattern suggests that you take a class that does something specific in a lot of different ways and extract all of these algorithms into separate classes called strategies.

The original class, called context, must have a field for storing a reference to one of the strategies. The context delegates the work to a linked strategy object instead of executing it on its own.

The context isn’t responsible for selecting an appropriate algorithm for the job. Instead, the client passes the desired strategy to the context. In fact, the context doesn’t know much about strategies. It works with all strategies through the same generic interface, which only exposes a single method for triggering the algorithm encapsulated within the selected strategy.

This way the context becomes independent of concrete strategies, so you can add new algorithms or modify existing ones without changing the code of the context or other strategies.

## The code Example

In this example, we have a PaymentService class that handles payments using different payment methods. The payment methods are defined as strategies, and we can easily switch between them without changing the PaymentService class.

## The Structure
#### The contract (interface)

**PaymentContract** Interface

The **PaymentContract** interface defines a contract for all payment methods. Each payment method must implement the **processPayment** method.
```php
<?php

namespace App\Payment;

interface PaymentContract
{
    public function processPayment(): string;
}

```

### The payment methods

We have two payment methods, **PaypalPaymentMethod** and StripePaymentMethod, both implementing the **PaymentContract** interface.

- PaypalPaymentMethod
```php
<?php

namespace App\Payment\PaymentMethod;

use App\Payment\PaymentContract;

class PaypalPaymentMethod implements PaymentContract
{
    public function processPayment(): string
    {
        return "this is a paypal payment method";
    }
}

```

- StripePaymentMethod
```php
<?php

namespace App\Payment\PaymentMethod;

use App\Payment\PaymentContract;

class StripePaymentMethod implements PaymentContract
{
    public function processPayment(): string
    {
        return "this is a stripe payment method";
    }
}

```
### The context (PaymentService)

The **PaymentService** class uses the selected payment method to process the payment. It accepts the payment method as a string parameter and initializes the appropriate payment method object.

```php
<?php

namespace App\Service;

use App\Payment\PaymentContract;
use App\Payment\PaymentMethod\PaypalPaymentMethod;
use App\Payment\PaymentMethod\StripePaymentMethod;
use InvalidArgumentException;

class PaymentService
{
    private PaymentContract $payment;

    public function __construct(string $paymentMethodSelected)
    {
        $this->payment = match ($paymentMethodSelected) {
            "paypal" => new PaypalPaymentMethod(),
            "stripe" => new StripePaymentMethod(),
            default => throw new InvalidArgumentException("no payment method selected")
        };
    }

    public function pay(): string
    {
        return $this->payment->processPayment();
    }
}

```

## Usage inside a command:
```php

<?php

namespace App\Console\Commands;

use App\Service\PaymentService;
use Illuminate\Console\Command;

class InitPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init-payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $paymentMethodStripe = "stripe";
        $paymentServiceService = new PaymentService($paymentMethodStripe);
        $this->info($paymentServiceService->pay());
        $paymentMethodapaypal = "paypal";
        $PaypalPaymentService = new PaymentService($paymentMethodapaypal);
        $this->info($PaypalPaymentService->pay());
        $InvalidPaymentMethod = "invalid";
        $InvalidPaymentMethodService = new PaymentService($InvalidPaymentMethod);
        $this->info($InvalidPaymentMethodService->pay());
    }
}

    
```
## Conclusion 

The **Strategy pattern** provides a way to define a family of algorithms, encapsulate each one, and make them interchangeable. By implementing this pattern, we can easily switch between different payment methods without changing the PaymentService class. This makes our code more flexible and easier to maintain.



# Abstract Factory Design Pattern

## Overview

This app is a simple implementation of the Abstract Factory Design Pattern in PHP. The **Factory Method** is a creational design pattern that provides an interface for creating objects in a superclass, but allows subclasses to alter the type of objects that will be created.  In this example, we implement a document generation system that can create JSON and PDF documents .

## Structure

### Concrete Implementations

- **IGenerator**: The interface that defines the `generate` method for document generation.

```php
<?php

namespace App\Generators;

interface IGenerator
{
    public function generate(): string;
}

```

- **DocumentCreator**: An abstract class that defines the `createDocument` method and the `create` method that uses it.

```php
<?php

namespace App\Generators;

abstract class DocumentCreator
{
    abstract protected function createDocument(): IGenerator;
    public function create(): string
    {
        $document = $this->createDocument();
        return $document->generate();
    }
}

```

- **JsonDocumentGenerator**: Implements the `IGenerator` interface for generating JSON documents.

```php
<?php

namespace App\Generators\DocumentGenerators;

use App\Generators\IGenerator;

class JsonDocumentGenerator implements IGenerator
{
    public function generate(): string
    {
        return 'Generating a JSON document...';
    }
}

```
- **PdfDocumentGenerator**: Implements the `IGenerator` interface for generating PDF documents.

```php
<?php

namespace App\Generators\DocumentGenerators;

use App\Generators\IGenerator;


class PdfDocumentGenerator implements IGenerator
{
    public function generate(): string
    {
        return 'Generating a PDF document...';
    }
}

```
- **JsonDocumentCreator**: Extends the `DocumentCreator` abstract class to create `JsonDocumentGenerator` instances.

```php
<?php

namespace App\Generators\Creators;

use App\Generators\DocumentCreator;
use App\Generators\DocumentGenerators\JsonDocumentGenerator;
use App\Generators\IGenerator;

class JsonDocumentCreator extends DocumentCreator
{
    protected function createDocument(): IGenerator
    {
        return new JsonDocumentGenerator();
    }
}

```
- **PdfDocumentCreator**: Extends the `DocumentCreator` abstract class to create `PdfDocumentGenerator` instances.

```php
<?php

namespace App\Generators\Creators;

use App\Generators\DocumentCreator;
use App\Generators\DocumentGenerators\PdfDocumentGenerator;
use App\Generators\IGenerator;

class PdfDocumentCreator extends DocumentCreator
{
    protected function createDocument(): IGenerator
    {
        return new PdfDocumentGenerator();
    }
}

```
### Command
- **FactoryMethodCommand**: A Laravel console command that demonstrates the usage of the Abstract Factory pattern to generate JSON and PDF documents.

```php
<?php

namespace App\Console\Commands;

use App\Generators\Creators\JsonDocumentCreator;
use App\Generators\Creators\PdfDocumentCreator;
use App\Generators\DocumentCreator;
use App\Generators\IGenerator;
use Illuminate\Console\Command;

class FactoryMethodCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'factory-method-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'factory method command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $inputPdf = "pdf";
        $inputJson = "json";
        $this->info("Factory Method Command");
        $inputNull = "null";
        $creatorPdf = self::getCreator($inputPdf);
        $creatorJson = self::getCreator($inputJson);
        $creatorNull = self::getCreator($inputNull);
        $this->info($creatorPdf->create());
        $this->info($creatorJson->create());
        if ($creatorNull == null) {
            $this->info("null creation");
            return;
        } else {
            $this->info($creatorNull?->create());
        }


        // $creatorJson->create();
    }
    public static function getCreator(string $type): ?DocumentCreator
    {
        switch ($type) {
            case 'json':
                return new JsonDocumentCreator();
            case 'pdf':
                return new PdfDocumentCreator();
            default:
                return null;
        }
    }
}

```







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






# Adapter Design Pattern Implementation in PHP
## Overview

This project demonstrates the Adapter Design Pattern in PHP for a notification system. The Adapter Design Pattern allows different notification services (such as email and SMS) to be used interchangeably by providing a common interface.

## Code Structure

### Services
1. EmailService : Handles sending email notifications.

```php
// src/Services/EmailService.php
namespace Zack\LaravelAdapterDesignPattern\Services;

class EmailService
{
    public function sendEmail($to, $message): string
    {
        // Implementation for sending email using email service
        return "Email sent to $to with message '$message'";
    }
}

```
2. SmsService : Handles sending SMS notifications
```php 
<?php

namespace Zack\LaravelAdapterDesignPattern\Services;

class SmsService
{
    // Implementation for sending SMS using SMS service
    public function sendSMS($to, $message): string
    {
        return "SMS sent to $to with message '$message'";
    }
}
```
###  Adapters
1. EmailAdapter : Adapts EmailService to the AppNotificationContract interface.
```php
<?php

namespace Zack\LaravelAdapterDesignPattern\Adapters;

use Zack\LaravelAdapterDesignPattern\Contracts\AppNotificationContract;
use Zack\LaravelAdapterDesignPattern\Services\EmailService;

class EmailAdapter implements AppNotificationContract
{
    private $emailService;
    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }
    public function sendNotification($to, $message): string
    {
        return $this->emailService->sendEmail($to, $message);
    }
}
```
2. SmsAdapter : Adapts SmsService to the AppNotificationContract interface.
```php
<?php

namespace Zack\LaravelAdapterDesignPattern\Adapters;

use Zack\LaravelAdapterDesignPattern\Contracts\AppNotificationContract;
use Zack\LaravelAdapterDesignPattern\Services\SmsService;

class SmsAdapter implements AppNotificationContract
{
    private $smsService;
    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }
    public function sendNotification($to, $message): string
    {
        return $this->smsService->sendSMS($message, $to);
    }
}
```
### Contract
1. AppNotificationContract : Defines a common interface for sending notifications.

```php
<?php

namespace Zack\LaravelAdapterDesignPattern\Contracts;

interface AppNotificationContract
{
    public function sendNotification($to, $message): string;
}
```
### Main Service
1. NotificationService : Uses an adapter to send notifications, ensuring decoupling from specific service implementations.

```php
<?php

namespace Zack\LaravelAdapterDesignPattern;

use Zack\LaravelAdapterDesignPattern\Contracts\AppNotificationContract;

class NotificationService
{
    private AppNotificationContract $appNotificationContract;
    public function __construct(AppNotificationContract $appNotificationContract)
    {
        $this->appNotificationContract = $appNotificationContract;
    }
    public function notify(string $message, string $to): string
    {
        return $this->appNotificationContract->sendNotification($message, $to);
    }
}
```
### Usage example 
```php
<?php

use Zack\LaravelAdapterDesignPattern\Adapters\EmailAdapter;
use Zack\LaravelAdapterDesignPattern\Adapters\SmsAdapter;
use Zack\LaravelAdapterDesignPattern\NotificationService;
use Zack\LaravelAdapterDesignPattern\Services\EmailService;
use Zack\LaravelAdapterDesignPattern\Services\SmsService;

require 'vendor/autoload.php';
// email service usage
$emailService = new EmailService();
$emailAdapter = new EmailAdapter($emailService);
$notificationService = new NotificationService($emailAdapter);
echo $notificationService->notify("alhossnizakaria@gmail.com", "This is an SMS notification.") . "\n";



// sms service usage
$smsService = new SmsService();
$smsAdapter = new SmsAdapter($smsService);
$notificationService = new NotificationService($smsAdapter);
echo $notificationService->notify("This is an email notification.", "1234567890") . "\n";
```
### Design Explanation
1. Services: EmailService and SmsService handle the specific implementations for sending notifications.
2. Adapters: EmailAdapter and SmsAdapter adapt the service methods to a common interface AppNotificationContract.
3. Contract: AppNotificationContract ensures a unified method for sending notifications across different notifications.
4. Main Service: NotificationService utilizes adapters to decouple notification sending logic from specific implementations.

