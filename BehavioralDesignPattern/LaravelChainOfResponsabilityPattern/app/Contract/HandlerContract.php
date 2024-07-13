<?php

namespace App\Contract;

use App\Data\Ticket;

interface HandlerContract
{

    /** set the next handler: */
    public function setNext(HandlerContract $next);
    /** run this handler's code */
    public function handle(Ticket $ticket = null);
    /** run the next handler  */
    public function next(Ticket $ticket = null);
}
