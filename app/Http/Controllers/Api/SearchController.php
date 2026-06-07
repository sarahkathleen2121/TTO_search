<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\AiSearchClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{
    public function __construct(protected AiSearchClient $aiSearch) {}

    public function suggestions(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'q' => 'nullable|string|max:100',
            'limit' => 'nullable|integer|min:1|max:12',
        ]);

        $query = trim($validated['q'] ?? '');
        if (strlen($query) < 2) {
            return response()->json(['suggestions' => []]);
        }

        $limit = $validated['limit'] ?? 8;
        $suggestions = [];

        $products = Product::query()
            ->where('name', 'like', '%'.$query.'%')
            ->orderByRaw('CASE WHEN name LIKE ? THEN 0 ELSE 1 END', [$query.'%'])
            ->limit(4)
            ->get(['id', 'name', 'slug']);

        foreach ($products as $product) {
            $suggestions[] = [
                'text' => $product->name,
                'kind' => 'product',
                'url' => route('product.detail', $product->slug),
            ];
        }

        try {
            $cacheKey = 'ai_search_suggest_'.md5($query.'_'.$limit);
            $ai = Cache::remember($cacheKey, 120, function () use ($query, $limit) {
                return $this->aiSearch->suggest($query, $limit);
            });
            $existing = collect($suggestions)->pluck('text')->map(fn ($t) => strtolower($t))->all();
            foreach ($ai['suggestions'] ?? [] as $item) {
                $text = trim($item['text'] ?? '');
                if ($text === '' || in_array(strtolower($text), $existing, true)) {
                    continue;
                }
                $suggestions[] = [
                    'text' => $text,
                    'kind' => $item['kind'] ?? 'query',
                    'url' => null,
                ];
                $existing[] = strtolower($text);
                if (count($suggestions) >= $limit) {
                    break;
                }
            }
        } catch (\Throwable) {
            // Product name matches still returned
        }

        return response()->json([
            'suggestions' => array_slice($suggestions, 0, $limit),
        ]);
    }

    public function text(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'query' => 'required|string|max:500',
            'filters' => 'nullable|array',
            'filters.category' => 'nullable|string',
            'filters.color' => 'nullable|string',
            'filters.material' => 'nullable|string',
            'filters.brand' => 'nullable|string',
            'filters.availability' => 'nullable|string',
            'sort' => 'nullable|string|in:relevance,category,price',
            'page' => 'nullable|integer|min:1',
            'limit' => 'nullable|integer|min:1|max:100',
        ]);

        try {
            $data = $this->fetchTextSearch($validated);

            return response()->json($this->enrichResults($data));
        } catch (\Throwable $e) {
            if (config('ai-search.fallback_sql')) {
                return response()->json($this->fallbackTextSearch($validated));
            }

            return response()->json(['message' => 'Search temporarily unavailable.'], 503);
        }
    }

    public function image(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'filters' => 'nullable|array',
            'sort' => 'nullable|string|in:relevance,category,price',
            'page' => 'nullable|integer|min:1',
            'limit' => 'nullable|integer|min:1|max:100',
        ]);

        try {
            $data = $this->aiSearch->searchImage($request->file('image'), [
                'filters' => isset($validated['filters']) ? json_encode($validated['filters']) : null,
                'sort' => $validated['sort'] ?? 'relevance',
                'page' => $validated['page'] ?? 1,
                'limit' => $validated['limit'] ?? 20,
            ]);

            return response()->json($this->enrichResults($data));
        } catch (\Throwable $e) {
            return response()->json([
                'results' => [],
                'related_results' => [],
                'total' => 0,
                'confidence' => 'none',
                'message' => 'Image search is temporarily unavailable.',
            ], 503);
        }
    }

    public function scene(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'x' => 'required|numeric|min:0|max:1',
            'y' => 'required|numeric|min:0|max:1',
            'width' => 'required|numeric|min:0.01|max:1',
            'height' => 'required|numeric|min:0.01|max:1',
            'filters' => 'nullable|array',
            'sort' => 'nullable|string|in:relevance,category,price',
            'page' => 'nullable|integer|min:1',
            'limit' => 'nullable|integer|min:1|max:100',
        ]);

        try {
            $data = $this->aiSearch->searchScene($request->file('image'), [
                'x' => $validated['x'],
                'y' => $validated['y'],
                'width' => $validated['width'],
                'height' => $validated['height'],
            ], [
                'filters' => isset($validated['filters']) ? json_encode($validated['filters']) : null,
                'sort' => $validated['sort'] ?? 'relevance',
                'page' => $validated['page'] ?? 1,
                'limit' => $validated['limit'] ?? 20,
            ]);

            return response()->json($this->enrichResults($data));
        } catch (\Throwable $e) {
            return response()->json([
                'results' => [],
                'total' => 0,
                'confidence' => 'none',
                'message' => 'Scene search is temporarily unavailable.',
            ], 503);
        }
    }

    public function filters(): JsonResponse
    {
        try {
            return response()->json($this->aiSearch->filters());
        } catch (\Throwable $e) {
            return response()->json([
                'categories' => Product::query()->join('product_types', 'products.product_type_id', '=', 'product_types.id')->distinct()->pluck('product_types.name'),
                'colors' => [],
                'materials' => [],
                'brands' => Product::query()->join('brands', 'products.brand_id', '=', 'brands.id')->distinct()->pluck('brands.name'),
            ]);
        }
    }

    public function health(): JsonResponse
    {
        try {
            return response()->json($this->aiSearch->health());
        } catch (\Throwable $e) {
            return response()->json(['status' => 'down'], 503);
        }
    }

    protected function fetchTextSearch(array $validated): array
    {
        $payload = [
            'query' => $validated['query'],
            'filters' => $validated['filters'] ?? null,
            'sort' => $validated['sort'] ?? 'relevance',
            'page' => $validated['page'] ?? 1,
            'limit' => $validated['limit'] ?? 20,
        ];

        $cacheKey = 'ai_search_text_v2_'.md5(json_encode($validated));

        if (config('ai-search.cache_enabled') && Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $data = $this->aiSearch->searchText($payload);

        if (config('ai-search.cache_enabled') && ! empty($data['results'])) {
            Cache::put($cacheKey, $data, config('ai-search.cache_ttl'));
        }

        return $data;
    }

    protected function enrichResults(array $data): array
    {
        $data['results'] = $this->enrichProductList($data['results'] ?? []);
        $data['related_results'] = $this->enrichProductList($data['related_results'] ?? []);

        return $data;
    }

    protected function enrichProductList(array $items): array
    {
        $ids = collect($items)->pluck('id')->filter()->all();
        $products = Product::query()
            ->with('productType')
            ->whereIn('id', $ids)
            ->get()
            ->keyBy(fn (Product $p) => (string) $p->id);

        return collect($items)->map(function (array $item) use ($products) {
            $product = $products->get($item['id'] ?? null);
            if ($product) {
                $item['slug'] = $product->slug;
                $item['url'] = route('product.detail', $product->slug);
                $item['image_url'] = $product->referenceImageUrl() ?? $item['image_url'] ?? '';
                $item['title'] = $product->name;
                $item['price'] = $product->price;
                $item['category'] = $product->productType?->name ?? ($item['category'] ?? '');
            }

            return $item;
        })->values()->all();
    }

    protected function fallbackTextSearch(array $validated): array
    {
        $rawQuery = $validated['query'];

        // Extract meaningful keywords by removing stop words
        $stopWords = [
            'i', 'me', 'my', 'we', 'our', 'you', 'your', 'he', 'she', 'it', 'they',
            'a', 'an', 'the', 'this', 'that', 'these', 'those',
            'is', 'am', 'are', 'was', 'were', 'be', 'been', 'being',
            'have', 'has', 'had', 'do', 'does', 'did',
            'will', 'would', 'shall', 'should', 'can', 'could', 'may', 'might',
            'want', 'need', 'looking', 'looking', 'find', 'get', 'show',
            'for', 'of', 'in', 'on', 'at', 'to', 'with', 'from', 'by', 'about',
            'and', 'or', 'but', 'not', 'no', 'so', 'if', 'then',
            'some', 'any', 'all', 'very', 'just', 'also', 'please', 'thanks',
        ];

        $words = preg_split('/\s+/', strtolower(trim($rawQuery)));
        $keywords = array_values(array_filter($words, function ($w) use ($stopWords) {
            return strlen($w) >= 2 && !in_array($w, $stopWords, true);
        }));

        // Build query: search each keyword in name, description, product type name, and brand name
        $productsQuery = Product::query()
            ->with('productType')
            ->select('products.*');

        if (!empty($keywords)) {
            // Left join product types and brands so we can search their names too
            $productsQuery->leftJoin('product_types', 'products.product_type_id', '=', 'product_types.id')
                ->leftJoin('brands', 'products.brand_id', '=', 'brands.id');

            // Build a relevance score: count how many keywords match
            $relevanceParts = [];
            $bindings = [];
            foreach ($keywords as $kw) {
                $like = "%{$kw}%";
                $relevanceParts[] = '(CASE WHEN products.name LIKE ? THEN 2 ELSE 0 END)';
                $bindings[] = $like;
                $relevanceParts[] = '(CASE WHEN product_types.name LIKE ? THEN 2 ELSE 0 END)';
                $bindings[] = $like;
                $relevanceParts[] = '(CASE WHEN brands.name LIKE ? THEN 1 ELSE 0 END)';
                $bindings[] = $like;
                $relevanceParts[] = '(CASE WHEN products.description LIKE ? THEN 1 ELSE 0 END)';
                $bindings[] = $like;
            }
            $relevanceExpr = implode(' + ', $relevanceParts);
            $productsQuery->selectRaw("({$relevanceExpr}) as relevance_score", $bindings);

            // At least one keyword must match somewhere
            $productsQuery->where(function ($q) use ($keywords) {
                foreach ($keywords as $kw) {
                    $like = "%{$kw}%";
                    $q->orWhere('products.name', 'like', $like)
                      ->orWhere('products.description', 'like', $like)
                      ->orWhere('product_types.name', 'like', $like)
                      ->orWhere('brands.name', 'like', $like);
                }
            });

            $productsQuery->orderByDesc('relevance_score');
        } else {
            // No meaningful keywords, fall back to full phrase search
            $productsQuery->where('name', 'like', "%{$rawQuery}%")
                ->orWhere('description', 'like', "%{$rawQuery}%");
        }

        $products = $productsQuery->paginate($validated['limit'] ?? 20);

        $resultIds = $products->pluck('id')->all();

        // Build related products from same product types / brands as the results
        $relatedProducts = collect();
        if ($products->isNotEmpty()) {
            $typeIds = $products->pluck('product_type_id')->filter()->unique()->all();
            $brandIds = $products->pluck('brand_id')->filter()->unique()->all();

            $relatedProducts = Product::query()
                ->with('productType')
                ->whereNotIn('id', $resultIds)
                ->where(function ($q) use ($typeIds, $brandIds) {
                    if ($typeIds) {
                        $q->whereIn('product_type_id', $typeIds);
                    }
                    if ($brandIds) {
                        $q->orWhereIn('brand_id', $brandIds);
                    }
                })
                ->inRandomOrder()
                ->take(8)
                ->get();
        }

        // If still no related products, show random featured or latest products
        if ($relatedProducts->isEmpty()) {
            $relatedProducts = Product::query()
                ->with('productType')
                ->whereNotIn('id', $resultIds)
                ->where('is_featured', true)
                ->inRandomOrder()
                ->take(8)
                ->get();
        }

        if ($relatedProducts->isEmpty()) {
            $relatedProducts = Product::query()
                ->with('productType')
                ->whereNotIn('id', $resultIds)
                ->latest()
                ->take(8)
                ->get();
        }

        return [
            'results' => $products->map(fn (Product $p) => [
                'id' => (string) $p->id,
                'title' => $p->name,
                'slug' => $p->slug,
                'url' => route('product.detail', $p->slug),
                'image_url' => $p->referenceImageUrl(),
                'price' => $p->price,
                'category' => $p->productType?->name ?? '',
                'similarity_score' => 0.5,
            ])->values()->all(),
            'total' => $products->total(),
            'page' => $products->currentPage(),
            'limit' => $products->perPage(),
            'confidence' => 'medium',
            'message' => 'Showing keyword results (AI search offline).',
            'related_results' => $relatedProducts->map(fn (Product $p) => [
                'id' => (string) $p->id,
                'title' => $p->name,
                'slug' => $p->slug,
                'url' => route('product.detail', $p->slug),
                'image_url' => $p->referenceImageUrl(),
                'price' => $p->price,
                'category' => $p->productType?->name ?? '',
                'similarity_score' => 0.4,
            ])->values()->all(),
            'related_heading' => 'Related Products',
        ];
    }
}
