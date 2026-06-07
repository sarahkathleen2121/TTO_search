<?php

namespace App\Services;

use App\Models\Product;

class ProductSearchExporter
{
    public function __construct(protected AiSearchClient $client) {}

    public function exportPayloads(): array
    {
        return Product::query()
            ->with(['brand', 'productType', 'colors', 'materials'])
            ->orderBy('id')
            ->get()
            ->map(fn (Product $product) => $this->client->productPayload($product))
            ->all();
    }
}
