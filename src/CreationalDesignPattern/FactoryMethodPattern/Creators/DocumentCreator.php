<?php

namespace Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Creators;

use Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Contracts\IGenerator;

abstract class DocumentCreator
{
    abstract protected function createDocument(): IGenerator;
    public function create(): string
    {
        $document = $this->createDocument();
        return $document->generate();
    }
}