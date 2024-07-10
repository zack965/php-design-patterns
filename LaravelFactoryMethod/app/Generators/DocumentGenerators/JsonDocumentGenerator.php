<?php

namespace App\Generators\DocumentGenerators;

use App\Generators\IGenerator;

class JsonDocumentGenerator implements IGenerator
{
    public function generate(): string
    {
        return 'Generating a JSON document...';
    }
}
