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