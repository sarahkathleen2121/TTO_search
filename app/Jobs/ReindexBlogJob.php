<?php

namespace App\Jobs;

use App\Models\Blog;
use App\Services\AiSearchClient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ReindexBlogJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public int $blogId,
        public bool $delete = false,
    ) {}

    public function handle(AiSearchClient $client): void
    {
        if (! $client->isEnabled()) {
            return;
        }

        if ($this->delete) {
            try {
                $client->deleteBlog((string) $this->blogId);
            } catch (\Throwable $e) {
                Log::warning('AI index delete blog failed', ['id' => $this->blogId, 'error' => $e->getMessage()]);
            }

            return;
        }

        $blog = Blog::query()->find($this->blogId);
        if (! $blog) {
            return;
        }

        try {
            $payload = $client->blogPayload($blog);
            $client->indexBlog($payload);
        } catch (\Throwable $e) {
            Log::warning('AI index blog failed', ['id' => $this->blogId, 'error' => $e->getMessage()]);
        }
    }
}
