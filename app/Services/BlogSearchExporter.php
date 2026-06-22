<?php

namespace App\Services;

use App\Models\Blog;

class BlogSearchExporter
{
    public function __construct(protected AiSearchClient $client) {}

    public function exportPayloads(): array
    {
        return Blog::query()
            ->with('categories')
            ->orderBy('id')
            ->get()
            ->map(fn (Blog $blog) => $this->client->blogPayload($blog))
            ->all();
    }
}
