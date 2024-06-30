<?php

namespace App\Handlers;

use App\Data\Ticket;
use App\Enums\LevelEnum;
use App\Handlers\Base\BaseHandler;

class HandlerLevelOne extends BaseHandler
{
    public function handle(Ticket $ticket = null)
    {
        // echo $ticket->getLevel()->value;
        if ($ticket->getLevel()->value == LevelEnum::LevelOne->value) {
            return "this ticket is being handling by handler one and ticket level is " . $ticket->getLevel()->value;
        }
        return $this->next($ticket);
    }
}
