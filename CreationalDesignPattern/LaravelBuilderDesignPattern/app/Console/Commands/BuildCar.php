<?php

namespace App\Console\Commands;

use App\Builder\CarBuilders\PorcheBuilder;
use App\Builder\ConcreteBuilder;
use Illuminate\Console\Command;

class BuildCar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:build-car';

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
        //
        $this->info("Command for building car ");
        $builder = new ConcreteBuilder();
        $PorcheBuilder = new PorcheBuilder();
        $PorcheBuilder->setBuilder($builder);
        $PorcheBuilder->buildPorche();
        $car = $builder->getCar();
        $this->info("Brand: " . $car->getBrand());
    }
}
