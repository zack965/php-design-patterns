<?php

namespace Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Generators;

use Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Contracts\IGenerator;

class JsonDocumentGenerator implements IGenerator
{
    public function generate(): string
    {
        return 'Generating a JSON document...';
    }
}