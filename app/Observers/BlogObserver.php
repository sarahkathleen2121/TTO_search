<?php

namespace App\Observers;

use App\Jobs\ReindexBlogJob;
use App\Models\Blog;

class BlogObserver
{
    public function saved(Blog $blog): void
    {
        ReindexBlogJob::dispatch($blog->id);
    }

    public function deleted(Blog $blog): void
    {
        ReindexBlogJob::dispatch($blog->id, delete: true);
    }
}
