<?php


require 'vendor/autoload.php';

use Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Creators\DocumentCreator;
use Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Creators\JsonDocumentCreator;
use Zack\LaravelDesignPatterns\CreationalDesignPattern\FactoryMethodPattern\Creators\PdfDocumentCreator;




$inputPdf = "pdf";
$inputJson = "json";
$inputNull = "null";
$creatorPdf = getCreator($inputPdf);
$creatorJson = getCreator($inputJson);
$creatorNull = getCreator($inputNull);
echo $creatorPdf->create() . "\n";
echo $creatorJson->create() . "\n";
if ($creatorNull == null) {
    echo "null creation \n";
    return;
} else {
    echo $creatorNull?->create() . "\n";
}

function getCreator(string $type): ?DocumentCreator
{
    switch ($type) {
        case 'json':
            return new JsonDocumentCreator();
        case 'pdf':
            return new PdfDocumentCreator();
        default:
            return null;
    }
}