<?php

namespace Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Creators;

use Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Contracts\IGenerator;
use Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Generators\JsonDocumentGenerator;

class JsonDocumentCreator extends DocumentCreator
{
    protected function createDocument(): IGenerator
    {
        return new JsonDocumentGenerator();
    }
}