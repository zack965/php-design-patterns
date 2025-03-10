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

namespace Zack\LaravelDesignPatterns\BehavioralDesignPattern\StrategyPattern\Contracts;


interface IPaymentContract
{
    public function processPayment(): string;
}

```

### The payment methods

We have two payment methods, **PaypalPaymentMethod** and StripePaymentMethod, both implementing the **PaymentContract** interface.

- PaypalPaymentMethod
```php
<?php

namespace Zack\LaravelDesignPatterns\BehavioralDesignPattern\StrategyPattern\PaymentMethods;

use Zack\LaravelDesignPatterns\BehavioralDesignPattern\StrategyPattern\Contracts\IPaymentContract;

class PaypalPaymentMethod implements IPaymentContract
{
    public function processPayment(): string
    {
        return "this is a paypal payment method \n";
    }
}

```

- StripePaymentMethod
```php
<?php

namespace Zack\LaravelDesignPatterns\BehavioralDesignPattern\StrategyPattern\PaymentMethods;


use Zack\LaravelDesignPatterns\BehavioralDesignPattern\StrategyPattern\Contracts\IPaymentContract;

class StripePaymentMethod implements IPaymentContract
{
    public function processPayment(): string
    {
        return "this is a stripe payment method \n";
    }
}

```
### The context (PaymentService)

The **PaymentService** class uses the selected payment method to process the payment. It accepts the payment method as a string parameter and initializes the appropriate payment method object.

```php
<?php

namespace Zack\LaravelDesignPatterns\BehavioralDesignPattern\StrategyPattern\Services;


use InvalidArgumentException;
use Zack\LaravelDesignPatterns\BehavioralDesignPattern\StrategyPattern\Contracts\IPaymentContract;
use Zack\LaravelDesignPatterns\BehavioralDesignPattern\StrategyPattern\PaymentMethods\PaypalPaymentMethod;
use Zack\LaravelDesignPatterns\BehavioralDesignPattern\StrategyPattern\PaymentMethods\StripePaymentMethod;

class PaymentService
{
    private IPaymentContract $payment;

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

require 'vendor/autoload.php';
use Zack\LaravelDesignPatterns\BehavioralDesignPattern\StrategyPattern\Services\PaymentService;
$paymentMethodStripe = "stripe";
$paymentServiceService = new PaymentService($paymentMethodStripe);

echo $paymentServiceService->pay();
$paymentMethodapaypal = "paypal";
$PaypalPaymentService = new PaymentService($paymentMethodapaypal);
echo $PaypalPaymentService->pay();


// this will llunch an exception
$InvalidPaymentMethod = "invalid";
$InvalidPaymentMethodService = new PaymentService($InvalidPaymentMethod);
echo $InvalidPaymentMethodService->pay();


    
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

namespace Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Contracts;
interface IGenerator
{
    public function generate(): string;
}


```

- **DocumentCreator**: An abstract class that defines the `createDocument` method and the `create` method that uses it.

```php
<?php

namespace Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Creators;

use Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Contracts\IGenerator;

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

namespace Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Generators;

use Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Contracts\IGenerator;

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

namespace Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Generators;

use Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Contracts\IGenerator;

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

namespace Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Creators;

use Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Contracts\IGenerator;
use Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Generators\JsonDocumentGenerator;

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

namespace Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Creators;

use Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Contracts\IGenerator;
use Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Generators\PdfDocumentGenerator;

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


require 'vendor/autoload.php';

use Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Creators\DocumentCreator;
use Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Creators\JsonDocumentCreator;
use Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Creators\PdfDocumentCreator;




$inputPdf = "pdf";
$inputJson = "json";
$inputNull = "null";
$creatorPdf = getCreator($inputPdf);
$creatorJson = getCreator($inputJson);
$creatorNull = getCreator($inputNull);
echo $creatorPdf->create() . "\n";
echo $creatorJson->create() . "\n";
if ($creatorNull == null) {
    echo "null creation \n";
    return;
} else {
    echo $creatorNull?->create() . "\n";
}
/**
 * Undocumented function
 *
 * @param string $type
 * @return DocumentCreator|null
 */
function getCreator(string $type): ?DocumentCreator
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
namespace Zack\LaravelDesignPatterns\CreationalDesignPattern\BuilderDesignPattern\Builder;


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
```
#### Concrete Builder: ConcreteBuilder
The **ConcreteBuilder** class implements the **ICarBuilder** interface and provides the actual implementations for constructing the **Car** parts.
```php
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

```
### Director: PorcheBuilder
The **PorcheBuilder** class is responsible for managing the construction process. It specifies the order in which to call the building steps to construct a particular configuration of the **Car**.
```php
<?php

namespace Zack\LaravelDesignPatterns\CreationalDesignPattern\BuilderDesignPattern\Builder;

use Zack\LaravelDesignPatterns\CreationalDesignPattern\BuilderDesignPattern\Contracts\ICarBuilder;

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


```






# Adapter Design Pattern Implementation in PHP
## Overview

This project demonstrates the Adapter Design Pattern in PHP for a notification system. The Adapter Design Pattern allows different notification services (such as email and SMS) to be used interchangeably by providing a common interface.

## Code Structure

### Services
1. EmailService : Handles sending email notifications.

```php
<?php
namespace Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Services;


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
namespace Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Services;

class SmsService
{
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
namespace Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Adapters;

use Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Contracts\IAppNotificationContract;
use Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Services\EmailService;

class EmailAdapter implements IAppNotificationContract
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
namespace Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Adapters;

use Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Contracts\IAppNotificationContract;
use Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Services\SmsService;

class SmsAdapter implements IAppNotificationContract
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
namespace Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Contracts;


interface IAppNotificationContract
{
    public function sendNotification($to, $message): string;
}
```
### Main Service
1. NotificationService : Uses an adapter to send notifications, ensuring decoupling from specific service implementations.

```php
<?php
namespace Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Services;

use Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Contracts\IAppNotificationContract;

class Notifier
{
    private IAppNotificationContract $appNotificationContract;
    public function __construct(IAppNotificationContract $appNotificationContract)
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

use Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Adapters\EmailAdapter;
use Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Adapters\SmsAdapter;
use Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Services\EmailService;
use Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Services\Notifier;
use Zack\LaravelDesignPatterns\StructuralDesignPattern\AdapterDesignPattern\Services\SmsService;

require 'vendor/autoload.php';


// email service usage
$emailService = new EmailService();
$emailAdapter = new EmailAdapter($emailService);
$notificationService = new Notifier($emailAdapter);
echo $notificationService->notify("alhossnizakaria@gmail.com", "This is an Email notification.") . "\n";



// sms service usage
$smsService = new SmsService();
$smsAdapter = new SmsAdapter($smsService);
$notificationService = new Notifier($smsAdapter);
echo $notificationService->notify("This is an SMS notification.", "1234567890") . "\n";
```
### Design Explanation
1. Services: EmailService and SmsService handle the specific implementations for sending notifications.
2. Adapters: EmailAdapter and SmsAdapter adapt the service methods to a common interface AppNotificationContract.
3. Contract: AppNotificationContract ensures a unified method for sending notifications across different notifications.
4. Main Service: NotificationService utilizes adapters to decouple notification sending logic from specific implementations.




# Singleton Design Pattern in PHP

### Overview

This project demonstrates the Singleton Design Pattern in PHP. The Singleton Pattern ensures that a class has only one instance and provides a global point of access to it. This is particularly useful for managing shared resources like database connections.
### Implementation
1. DatabaseInstance Class : The DatabaseInstance class is designed to follow the Singleton Design Pattern. It ensures that only one instance of the database connection exists throughout the application's lifecycle.
```php

<?php
namespace Zack\LaravelDesignPatterns\CreationalDesignPattern\SignleTonDesignPattern;


class DatabaseInstance
{
    // The single instance of the class
    private static $instance = null;

    // Database connection parameters
    private string $host;
    private string $port;

    // Private constructor to prevent direct creation of object
    private function __construct($host, $port)
    {
        $this->host = $host;
        $this->port = $port;
    }
    // Method to get the single instance of the class
    public static function getInstance($host, $port)
    {
        if (self::$instance === null) {
            self::$instance = new self($host, $port);
        }

        return self::$instance;
    }
    // Prevent cloning of the instance
    protected function __clone()
    {
    }
    // Prevent unserializing of the instance
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }
    // Example method to demonstrate functionality
    public function connect()
    {
        // Code to connect to the database using $this->host and $this->port
        echo "Connected to the database at $this->host:$this->port." . "\n";
    }
}
```
### Client Code
```php
<?php

use Zack\LaravelDesignPatterns\CreationalDesignPattern\SignleTonDesignPattern\DatabaseInstance;

require "vendor/autoload.php";

$db = DatabaseInstance::getInstance('localhost', 3306);
$db->connect();
```
### Explanation
- Private Constructor: The constructor is private to prevent direct creation of objects from outside the class.
- Static getInstance Method: This method checks if an instance of the class already exists. If not, it creates one and returns it. This ensures that only one instance exists.
- Cloning and Unserialization Prevention: The __clone method is protected to prevent cloning of the instance. The __wakeup method throws an exception to prevent unserialization of the instance.

# Facade Design Pattern
### Overview


This project demonstrates the implementation of the **Facade Design Pattern** in a smart home context. The Facade pattern provides a simplified interface to a complex subsystem, making it easier for users to interact with.

### Components
### Subsystems
-  LightSubSystem
    - Manages the home lighting system.
```php
<?php
namespace Zack\LaravelDesignPatterns\StructuralDesignPattern\FacadeDesignPattern\SubSystems;



class LightSubSystem
{
    public function turnOn(): string
    {
        return "Light Subsystem: Turning on the light\n";
    }

    public function turnOff(): string
    {
        return "Light Subsystem: Turning off the light\n";
    }

    public function changeColor(string $color): string
    {
        return "Light Subsystem: Changing the light color to {$color}\n";
    }
    public function changePattern(string $pattern): string
    {
        return "Light Subsystem: Changing the light pattern to {$pattern}\n";
    }
}

``` 

- WifiSubSystem
    - Manages WiFi connectivity.
```php
<?php
namespace Zack\LaravelDesignPatterns\StructuralDesignPattern\FacadeDesignPattern\SubSystems;


class WifiSubSystem
{
    public function TurnOff(): string
    {
        return "Wifi Subsystem: Turning off the WiFi\n";
    }
    public function ConnectToNetwork(string $networkName): string
    {
        return "Wifi Subsystem: Connecting to network '{$networkName}'\n";
    }
    public function ChangePassword(string $oldPassword, string $newPassword): string
    {
        return "Wifi Subsystem: Changing the password from '{$oldPassword}' to '{$newPassword}'\n";
    }
    public function DisconnectFromNetwork(): string
    {
        return "Wifi Subsystem: Disconnecting from the network\n";
    }
}

```

- Facade
    - SmartHomeFacade
    - Provides a simplified interface for common home automation tasks.
```php

<?php
namespace Zack\LaravelDesignPatterns\StructuralDesignPattern\FacadeDesignPattern\Facade;

use Zack\LaravelDesignPatterns\StructuralDesignPattern\FacadeDesignPattern\SubSystems\LightSubSystem;
use Zack\LaravelDesignPatterns\StructuralDesignPattern\FacadeDesignPattern\SubSystems\WifiSubSystem;

class SmartHomeFacade
{
    private $lightSubSystem;
    private $wifiSubSystem;
    public function __construct(LightSubSystem $lightSubSystem, WifiSubSystem $wifiSubSystem)
    {
        $this->lightSubSystem = $lightSubSystem;
        $this->wifiSubSystem = $wifiSubSystem;
    }

    public function GetReadyToSleep(): array
    {
        return [
            'Turn off lights' => $this->lightSubSystem->TurnOff(),
            'Disconnect from network' => $this->wifiSubSystem->DisconnectFromNetwork(),
        ];
    }
}

```
- client code 
```php 
<?php

use Zack\LaravelDesignPatterns\StructuralDesignPattern\FacadeDesignPattern\Facade\SmartHomeFacade;
use Zack\LaravelDesignPatterns\StructuralDesignPattern\FacadeDesignPattern\SubSystems\LightSubSystem;
use Zack\LaravelDesignPatterns\StructuralDesignPattern\FacadeDesignPattern\SubSystems\WifiSubSystem;

require "vendor/autoload.php";




$lightSubSystem = new LightSubSystem();

$wifiSubSystem = new WifiSubSystem();

$smartHomeFacade = new SmartHomeFacade($lightSubSystem, $wifiSubSystem);

print_r($smartHomeFacade->GetReadyToSleep());

```

# Chain of Responsibility Design Pattern Implementation

 This project demonstrates the Chain of Responsibility design pattern in PHP. The pattern is used to create a chain of handler objects where each handler processes a request or passes it to the next handler in the chain.
### Overview


The Chain of Responsibility pattern is a behavioral design pattern that allows an object to pass a request along a chain of handlers. Each handler decides either to process the request or to pass it to the next handler in the chain.
In this implementation:
- A **Ticket** object represents a request that needs to be processed.
- Handlers (**HandlerLevelOne**, **HandlerLevelTwo**, **HandlerLevelThree**) process the Ticket based on its level.
- If a handler cannot process the request, it passes the request to the next handler in the chain.
### Code Structure

The project is organized into the following files:
- **HandlerContract.php**

Defines the contract for all handlers. It includes methods for setting the next handler and processing the request.
```php
<?php

namespace Zack\LaravelDesignPatterns\BehavioralDesignPattern\ChainOfResponsabilityDesignPattern\Contract;

use Zack\LaravelDesignPatterns\BehavioralDesignPattern\ChainOfResponsabilityDesignPattern\Data\Ticket;

interface HandlerContract
{
    public function setNext(HandlerContract $next);
    /** run this handler's code */
    public function handle(?Ticket $ticket = null);
    /** run the next handler  */
    public function next(?Ticket $ticket = null);
}
```
- **Ticket.php**

Represents the request object. It contains properties like **title**, **content**, and **level**, which determine how the request should be handled.
```php
<?php
namespace Zack\LaravelDesignPatterns\BehavioralDesignPattern\ChainOfResponsabilityDesignPattern\Data;

use Zack\LaravelDesignPatterns\BehavioralDesignPattern\ChainOfResponsabilityDesignPattern\Enum\LevelEnum;

class Ticket
{

    private string $title;
    private string $content;
    private LevelEnum $level;

    public function __construct($title, $content, $level)
    {
        $this->title = $title;
        $this->content = $content;
        $this->level = $level;
    }
    public function getLevel()
    {
        return $this->level;
    }
    public function setLevel(LevelEnum $level)
    {
        return $this->level = $level;
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function updateTitle($newTitle)
    {
        $this->title = $newTitle;
    }
    public function setTitle($newTitle)
    {
        $this->title = $newTitle;
    }
}
```
- **LevelEnum.php**
Defines the levels of tickets as an enum. Each level corresponds to a specific handler.
```php
<?php

namespace Zack\LaravelDesignPatterns\BehavioralDesignPattern\ChainOfResponsabilityDesignPattern\Enum;

enum LevelEnum: string
{
    case LevelOne = "LevelOne";
    case LevelTwo = "LevelTwo";
    case LevelThree = "LevelThree";
}

```

- **BaseHandler.php**

An abstract base class that implements the **HandlerContract**. It provides default behavior for setting the next handler and passing the request to the next handler in the chain.

```php
<?php
namespace Zack\LaravelDesignPatterns\BehavioralDesignPattern\ChainOfResponsabilityDesignPattern\Handlers\Base;

use Zack\LaravelDesignPatterns\BehavioralDesignPattern\ChainOfResponsabilityDesignPattern\Contract\HandlerContract;

abstract class BaseHandler implements HandlerContract
{
    protected $next;
    /** set the next handler */
    public function setNext(HandlerContract $next)
    {
        $this->next = $next;
    }
    /** run the next handler */
    public function next($ticket = null)
    {
        if ($this->next) {
            // go to next one:
            return $this->next->handle($ticket);
        }
    }
}

```
- **HandlerLevelOne.php**, **HandlerLevelTwo.php**, **HandlerLevelThree.php**

Concrete handler classes that extend BaseHandler. Each handler processes the Ticket if its level matches the handler's responsibility.
```php
<?php


namespace Zack\LaravelDesignPatterns\BehavioralDesignPattern\ChainOfResponsabilityDesignPattern\Handlers;

use Zack\LaravelDesignPatterns\BehavioralDesignPattern\ChainOfResponsabilityDesignPattern\Data\Ticket;
use Zack\LaravelDesignPatterns\BehavioralDesignPattern\ChainOfResponsabilityDesignPattern\Enum\LevelEnum;
use Zack\LaravelDesignPatterns\BehavioralDesignPattern\ChainOfResponsabilityDesignPattern\Handlers\Base\BaseHandler;

class HandlerLevelOne extends BaseHandler
{
    public function handle(?Ticket $ticket = null)
    {
        // echo $ticket->getLevel()->value;
        if ($ticket->getLevel()->value == LevelEnum::LevelOne->value) {
            return "this ticket is being handling by handler one and ticket level is " . $ticket->getLevel()->value;
        }
        return $this->next($ticket);
    }
}

```

- **Client Code**

```php
<?php


require "vendor/autoload.php";



use Zack\LaravelDesignPatterns\BehavioralDesignPattern\ChainOfResponsabilityDesignPattern\Data\Ticket;
use Zack\LaravelDesignPatterns\BehavioralDesignPattern\ChainOfResponsabilityDesignPattern\Enum\LevelEnum;
use Zack\LaravelDesignPatterns\BehavioralDesignPattern\ChainOfResponsabilityDesignPattern\Handlers\HandlerLevelOne;
use Zack\LaravelDesignPatterns\BehavioralDesignPattern\ChainOfResponsabilityDesignPattern\Handlers\HandlerLevelThree;
use Zack\LaravelDesignPatterns\BehavioralDesignPattern\ChainOfResponsabilityDesignPattern\Handlers\HandlerLevelTwo;




$ticketLevelOne = new Ticket("ticket_level_one", "ticket_level_one_content", LevelEnum::LevelOne);
$ticketLevelTwo = new Ticket("ticket_level_two", "ticket_level_two_content", LevelEnum::LevelTwo);
$ticketLevelThree = new Ticket("ticket_level_three", "ticket_level_three_content", LevelEnum::LevelThree);
echo $ticketLevelOne->getLevel()->value . "\n";
echo $ticketLevelTwo->getLevel()->value . "\n";
echo $ticketLevelThree->getLevel()->value . "\n";
$handlerOne = new HandlerLevelOne();
$handlerTwo = new HandlerLevelTwo();
$handlerThree = new HandlerLevelThree();
$handlerOne->setNext($handlerTwo);
$handlerTwo->setNext($handlerThree);
echo $handlerOne->handle($ticketLevelThree) . "\n";
```

# # Prototype Design Pattern in PHP

This example demonstrates the **Prototype Design Pattern** using a `PersonPrototype` class in PHP.

## 📌 Overview
The **Prototype Pattern** is a creational design pattern that allows cloning of objects **without depending on their concrete class**. It is useful when object creation is expensive and we need a copy instead of creating a new instance.

## 🏗️ Implementation

### 1️⃣ **PersonPrototype Class**
This class represents a person with `name`, `age`, and `address`. It implements the `__clone()` method to perform deep cloning of the `Address` object.

```php


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
```
### Address Class

Since `PersonPrototype` contains an `Address` object, we need a separate class to handle address details.
```php

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
```

###  Client Code
This demonstrates cloning and modifying a `PersonPrototype` object.

```php

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

```