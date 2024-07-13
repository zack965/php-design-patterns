<?php

namespace App\Handlers\Base;

use App\Contract\HandlerContract;
use App\Data\Ticket;

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
        // else, no more to do
    }
}
