<?php

namespace Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Generators;

use Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Contracts\IGenerator;

class PdfDocumentGenerator implements IGenerator
{
    public function generate(): string
    {
        return 'Generating a PDF document...';
    }
}