<?php
namespace Zack\LaravelDesignPatterns\BehavioralDesignPattern\ChainOfResponsabilityDesignPattern\Handlers;

use Zack\LaravelDesignPatterns\BehavioralDesignPattern\ChainOfResponsabilityDesignPattern\Data\Ticket;
use Zack\LaravelDesignPatterns\BehavioralDesignPattern\ChainOfResponsabilityDesignPattern\Enum\LevelEnum;
use Zack\LaravelDesignPatterns\BehavioralDesignPattern\ChainOfResponsabilityDesignPattern\Handlers\Base\BaseHandler;

class HandlerLevelTwo extends BaseHandler
{
    public function handle(?Ticket $ticket = null)
    {
        if ($ticket->getLevel()->value == LevelEnum::LevelTwo->value) {
            return "this ticket is being handling by handler two and ticket level is " . $ticket->getLevel()->value;
        }
        return $this->next($ticket);
    }
}
