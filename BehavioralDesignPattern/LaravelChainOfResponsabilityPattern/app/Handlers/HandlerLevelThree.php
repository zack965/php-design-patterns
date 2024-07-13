<?php

namespace App\Handlers;

use App\Data\Ticket;
use App\Enums\LevelEnum;
use App\Handlers\Base\BaseHandler;

class HandlerLevelThree extends BaseHandler
{
    public function handle(Ticket $ticket = null)
    {
        if ($ticket->getLevel()->value == LevelEnum::LevelThree->value) {
            return "this ticket is being handling by handler three and ticket level is " . $ticket->getLevel()->value;
        }
        return $this->next($ticket);
    }
}
