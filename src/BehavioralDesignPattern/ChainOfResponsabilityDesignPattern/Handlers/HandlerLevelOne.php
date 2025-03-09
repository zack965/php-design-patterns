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
