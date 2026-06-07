<?php

namespace App\Observers;

use App\Jobs\ReindexProductJob;
use App\Models\Product;

class ProductObserver
{
    public function saved(Product $product): void
    {
        ReindexProductJob::dispatch($product->id);
    }

    public function deleted(Product $product): void
    {
        ReindexProductJob::dispatch($product->id, delete: true);
    }
}
