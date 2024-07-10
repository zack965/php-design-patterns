<?php

namespace App\Console\Commands;

use App\Generators\Creators\JsonDocumentCreator;
use App\Generators\Creators\PdfDocumentCreator;
use App\Generators\DocumentCreator;
use App\Generators\IGenerator;
use Illuminate\Console\Command;

class FactoryMethodCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'factory-method-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'factory method command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $inputPdf = "pdf";
        $inputJson = "json";
        $this->info("Factory Method Command");
        $inputNull = "null";
        $creatorPdf = self::getCreator($inputPdf);
        $creatorJson = self::getCreator($inputJson);
        $creatorNull = self::getCreator($inputNull);
        $this->info($creatorPdf->create());
        $this->info($creatorJson->create());
        if ($creatorNull == null) {
            $this->info("null creation");
            return;
        } else {
            $this->info($creatorNull?->create());
        }


        // $creatorJson->create();
    }
    public static function getCreator(string $type): ?DocumentCreator
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
}
