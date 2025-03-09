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