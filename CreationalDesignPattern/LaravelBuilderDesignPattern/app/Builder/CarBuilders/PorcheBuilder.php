<?php

namespace App\Builder\CarBuilders;

use App\Builder\ICarBuilder;

class PorcheBuilder
{

    private $builder;
    public function setBuilder(ICarBuilder $builder)
    {
        $this->builder = $builder;
    }
    public function buildPorche(): ICarBuilder
    {
        $this->builder->buildBrand('Porche');
        $this->builder->buildModel('Cayenne');
        $this->builder->buildYearOfRelease('2021');
        $this->builder->buildPrice(300000);
        $this->builder->buildTopSpeed(210);
        return $this->builder;
    }
}
