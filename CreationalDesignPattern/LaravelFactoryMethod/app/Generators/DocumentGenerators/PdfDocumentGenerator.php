<?php

namespace App\Generators\DocumentGenerators;

use App\Generators\IGenerator;


class PdfDocumentGenerator implements IGenerator
{
    public function generate(): string
    {
        return 'Generating a PDF document...';
    }
}
