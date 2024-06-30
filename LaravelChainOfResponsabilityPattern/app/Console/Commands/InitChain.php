<?php

namespace App\Console\Commands;

use App\Data\Ticket;
use App\Enums\LevelEnum;
use App\Handlers\HandlerLevelOne;
use App\Handlers\HandlerLevelThree;
use App\Handlers\HandlerLevelTwo;
use Illuminate\Console\Command;

class InitChain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init-chain';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $ticketLevelOne = new Ticket("ticket_level_one", "ticket_level_one_content", LevelEnum::LevelOne);
        $ticketLevelTwo = new Ticket("ticket_level_two", "ticket_level_two_content", LevelEnum::LevelTwo);
        $ticketLevelThree = new Ticket("ticket_level_three", "ticket_level_three_content", LevelEnum::LevelThree);
        $this->info($ticketLevelOne->getLevel()->value);
        $this->info($ticketLevelTwo->getLevel()->value);
        $this->info($ticketLevelThree->getLevel()->value);
        $handlerOne = new HandlerLevelOne();
        $handlerTwo = new HandlerLevelTwo();
        $handlerThree = new HandlerLevelThree();
        $handlerOne->setNext($handlerTwo);
        $handlerTwo->setNext($handlerThree);
        $this->info($handlerOne->handle($ticketLevelThree));
    }
}
