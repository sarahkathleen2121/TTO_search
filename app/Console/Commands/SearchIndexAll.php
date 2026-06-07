<?php

namespace App\Console\Commands;

use App\Services\AiSearchClient;
use App\Services\ProductSearchExporter;
use Illuminate\Console\Command;

class SearchIndexAll extends Command
{
    protected $signature = 'search:index-all {--chunk=25 : Products per bulk request}';

    protected $description = 'Export all products and bulk index into the AI search vector store';

    public function handle(AiSearchClient $client, ProductSearchExporter $exporter): int
    {
        if (! $client->isEnabled()) {
            $this->error('AI search is disabled.');

            return self::FAILURE;
        }

        $payloads = $exporter->exportPayloads();
        if (empty($payloads)) {
            $this->warn('No products to index.');

            return self::SUCCESS;
        }

        $chunkSize = (int) $this->option('chunk');
        $chunks = array_chunk($payloads, $chunkSize);
        $bar = $this->output->createProgressBar(count($chunks));
        $bar->start();

        $first = true;
        foreach ($chunks as $chunk) {
            $client->bulkIndex($chunk, replace: $first);
            $first = false;
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('Indexed '.count($payloads).' products.');

        return self::SUCCESS;
    }
}
