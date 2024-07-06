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