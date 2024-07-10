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
