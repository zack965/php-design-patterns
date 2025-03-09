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