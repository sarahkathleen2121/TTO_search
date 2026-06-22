<?php

namespace App\Console\Commands;

use App\Services\AiSearchClient;
use App\Services\BlogSearchExporter;
use Illuminate\Console\Command;

class SearchIndexBlogs extends Command
{
    protected $signature = 'search:index-blogs {--chunk=25 : Blogs per bulk request}';

    protected $description = 'Export all blogs and bulk index into the AI search vector store';

    public function handle(AiSearchClient $client, BlogSearchExporter $exporter): int
    {
        if (! $client->isEnabled()) {
            $this->error('AI search is disabled.');

            return self::FAILURE;
        }

        $payloads = $exporter->exportPayloads();
        if (empty($payloads)) {
            $this->warn('No blogs to index.');

            return self::SUCCESS;
        }

        $chunkSize = (int) $this->option('chunk');
        $chunks = array_chunk($payloads, $chunkSize);
        $bar = $this->output->createProgressBar(count($chunks));
        $bar->start();

        $first = true;
        foreach ($chunks as $chunk) {
            $client->bulkIndexBlogs($chunk, replace: $first);
            $first = false;
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('Indexed '.count($payloads).' blogs.');

        return self::SUCCESS;
    }
}
