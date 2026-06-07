<?php

namespace App\Jobs;

use App\Models\Product;
use App\Services\AiSearchClient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ReindexProductJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public int $productId,
        public bool $delete = false,
    ) {}

    public function handle(AiSearchClient $client): void
    {
        if (! $client->isEnabled()) {
            return;
        }

        if ($this->delete) {
            try {
                $client->deleteProduct((string) $this->productId);
            } catch (\Throwable $e) {
                Log::warning('AI index delete failed', ['id' => $this->productId, 'error' => $e->getMessage()]);
            }

            return;
        }

        $product = Product::query()->find($this->productId);
        if (! $product) {
            return;
        }

        try {
            $client->indexProduct($product);
        } catch (\Throwable $e) {
            Log::warning('AI index product failed', ['id' => $this->productId, 'error' => $e->getMessage()]);
        }
    }
}
