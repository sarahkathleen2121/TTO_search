<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Blog;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiSearchClient
{
    public function isEnabled(): bool
    {
        return (bool) config('ai-search.enabled');
    }

    public function health(): array
    {
        return $this->request('get', '/api/health');
    }

    public function searchText(array $payload): array
    {
        return $this->request('post', '/api/search/text', $payload);
    }

    public function suggest(string $query, int $limit = 8): array
    {
        return $this->request('get', '/api/search/suggest', [
            'q' => $query,
            'limit' => $limit,
        ]);
    }

    public function searchImage(UploadedFile $file, array $params = []): array
    {
        $response = Http::timeout(config('ai-search.timeout_image'))
            ->attach('image', fopen($file->getRealPath(), 'r'), $file->getClientOriginalName())
            ->post($this->url('/api/search/image'), $this->formParams($params));

        return $this->handleResponse($response);
    }

    public function searchScene(UploadedFile $file, array $coords, array $params = []): array
    {
        $response = Http::timeout(config('ai-search.timeout_image'))
            ->attach('image', fopen($file->getRealPath(), 'r'), $file->getClientOriginalName())
            ->post($this->url('/api/search/scene'), array_merge($this->formParams($params), $coords));

        return $this->handleResponse($response);
    }

    public function filters(): array
    {
        return $this->request('get', '/api/filters');
    }

    public function bulkIndex(array $products, bool $replace = true): array
    {
        $response = Http::timeout(config('ai-search.timeout_index', 600))
            ->connectTimeout(30)
            ->withHeaders(['X-API-Key' => config('ai-search.api_key')])
            ->post($this->url('/api/index/bulk'), [
                'products' => $products,
                'replace' => $replace,
            ]);

        return $this->handleResponse($response);
    }

    public function indexProduct(Product $product): array
    {
        return $this->request('post', '/api/index/product', $this->productPayload($product), true);
    }

    public function deleteProduct(string $productId): array
    {
        $response = Http::timeout(config('ai-search.timeout_text'))
            ->withHeaders(['X-API-Key' => config('ai-search.api_key')])
            ->delete($this->url('/api/index/product/'.$productId));

        return $this->handleResponse($response);
    }

    public function productPayload(Product $product): array
    {
        $product->loadMissing(['brand', 'productType', 'colors', 'materials']);

        return [
            'id' => (string) $product->id,
            'title' => $product->name,
            'description' => strip_tags($product->description ?? ''),
            'category' => $product->productType?->name ?? '',
            'brand' => $product->brand?->name ?? '',
            'colors' => $product->colors->pluck('name')->all(),
            'materials' => $product->materials->pluck('name')->all(),
            'price' => $product->price ? (float) $product->price : null,
            'availability' => $product->availability ?? 'in_stock',
            'slug' => $product->slug,
            'reference_image_url' => $product->referenceImageUrl() ?? '',
            'has_image_embedding' => $product->hasIndexableImage(),
        ];
    }

    public function blogPayload(Blog $blog): array
    {
        $blog->loadMissing('categories');

        return [
            'id' => (string) $blog->id,
            'title' => $blog->title,
            'slug' => $blog->slug,
            'content' => strip_tags($blog->content ?? ''),
            'category' => $blog->categories->first()?->name ?? '',
            'meta_keywords' => $blog->meta_keywords ?? '',
            'image_url' => $blog->featuredImageUrl() ?? '',
            'created_at' => $blog->created_at?->format('M d, Y') ?? '',
        ];
    }

    public function indexBlog(array $payload): array
    {
        return $this->request('post', '/api/index/blog', $payload, true);
    }

    public function deleteBlog(string $blogId): array
    {
        $response = Http::timeout(config('ai-search.timeout_text'))
            ->withHeaders(['X-API-Key' => config('ai-search.api_key')])
            ->delete($this->url('/api/index/blog/'.$blogId));

        return $this->handleResponse($response);
    }

    public function searchBlogs(array $payload): array
    {
        return $this->request('post', '/api/search/blogs', $payload);
    }

    public function bulkIndexBlogs(array $blogs, bool $replace = true): array
    {
        $response = Http::timeout(config('ai-search.timeout_index', 600))
            ->connectTimeout(30)
            ->withHeaders(['X-API-Key' => config('ai-search.api_key')])
            ->post($this->url('/api/index/blogs/bulk'), [
                'blogs' => $blogs,
                'replace' => $replace,
            ]);

        return $this->handleResponse($response);
    }

    protected function request(string $method, string $path, array $data = [], bool $auth = false): array
    {
        $http = Http::timeout(config('ai-search.timeout_text'))
            ->acceptJson()
            ->asJson();
        if ($auth) {
            $http = $http->withHeaders(['X-API-Key' => config('ai-search.api_key')]);
        }

        $response = $http->{$method}($this->url($path), $data);

        return $this->handleResponse($response);
    }

    protected function url(string $path): string
    {
        return rtrim(config('ai-search.base_url'), '/').$path;
    }

    protected function formParams(array $params): array
    {
        $out = [];
        if (isset($params['filters'])) {
            $out['filters'] = is_string($params['filters']) ? $params['filters'] : json_encode($params['filters']);
        }
        foreach (['sort', 'page', 'limit'] as $key) {
            if (isset($params[$key])) {
                $out[$key] = $params[$key];
            }
        }

        return $out;
    }

    protected function handleResponse($response): array
    {
        if ($response->failed()) {
            Log::warning('AI search request failed', ['status' => $response->status(), 'body' => $response->body()]);
            throw new \RuntimeException('AI search service unavailable');
        }

        return $response->json();
    }
}
