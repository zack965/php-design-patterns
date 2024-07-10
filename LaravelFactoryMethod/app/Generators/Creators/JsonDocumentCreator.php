<?php

namespace App\Generators\Creators;

use App\Generators\DocumentCreator;
use App\Generators\DocumentGenerators\JsonDocumentGenerator;
use App\Generators\IGenerator;

class JsonDocumentCreator extends DocumentCreator
{
    protected function createDocument(): IGenerator
    {
        return new JsonDocumentGenerator();
    }
}
