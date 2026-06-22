<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
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
            'filters.product_type' => 'nullable|string',
            'filters.space' => 'nullable|string',
            'filters.color' => 'nullable|string',
            'filters.material' => 'nullable|string',
            'filters.brand' => 'nullable|string',
            'filters.min_price' => 'nullable|numeric',
            'filters.max_price' => 'nullable|numeric',
            'filters.availability' => 'nullable|string',
            'sort' => 'nullable|string',
            'page' => 'nullable|integer|min:1',
            'limit' => 'nullable|integer|min:1|max:100',
        ]);

        try {
            $vectorIds = null;
            if (config('ai-search.enabled')) {
                $payload = [
                    'query' => $validated['query'],
                    'sort' => 'relevance',
                    'page' => 1,
                    'limit' => 200,
                ];
                $data = $this->aiSearch->searchText($payload);
                $vectorIds = collect($data['results'] ?? [])->pluck('id')->all();
            }

            return response()->json($this->queryProducts($validated, $vectorIds));
        } catch (\Throwable $e) {
            if (config('ai-search.fallback_sql')) {
                return response()->json($this->queryProducts($validated, null));
            }

            return response()->json(['message' => 'Search temporarily unavailable.'], 503);
        }
    }

    public function image(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'filters' => 'nullable|array',
            'filters.product_type' => 'nullable|string',
            'filters.space' => 'nullable|string',
            'filters.color' => 'nullable|string',
            'filters.material' => 'nullable|string',
            'filters.brand' => 'nullable|string',
            'filters.min_price' => 'nullable|numeric',
            'filters.max_price' => 'nullable|numeric',
            'filters.availability' => 'nullable|string',
            'sort' => 'nullable|string',
            'page' => 'nullable|integer|min:1',
            'limit' => 'nullable|integer|min:1|max:100',
        ]);

        try {
            $data = $this->aiSearch->searchImage($request->file('image'), [
                'sort' => 'relevance',
                'page' => 1,
                'limit' => 200,
            ]);
            $vectorIds = collect($data['results'] ?? [])->pluck('id')->all();

            return response()->json($this->queryProducts($validated, $vectorIds));
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
            'filters.product_type' => 'nullable|string',
            'filters.space' => 'nullable|string',
            'filters.color' => 'nullable|string',
            'filters.material' => 'nullable|string',
            'filters.brand' => 'nullable|string',
            'filters.min_price' => 'nullable|numeric',
            'filters.max_price' => 'nullable|numeric',
            'filters.availability' => 'nullable|string',
            'sort' => 'nullable|string',
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
                'sort' => 'relevance',
                'page' => 1,
                'limit' => 200,
            ]);
            $vectorIds = collect($data['results'] ?? [])->pluck('id')->all();

            return response()->json($this->queryProducts($validated, $vectorIds));
        } catch (\Throwable $e) {
            return response()->json([
                'results' => [],
                'total' => 0,
                'confidence' => 'none',
                'message' => 'Scene search is temporarily unavailable.',
            ], 503);
        }
    }

    protected function queryProducts(array $validated, ?array $vectorIds = null): array
    {
        $filters = $validated['filters'] ?? [];
        $sort = $validated['sort'] ?? 'relevance';
        $limit = intval($validated['limit'] ?? 9);

        $productsQuery = Product::query()
            ->with(['brand', 'productType']);

        if ($vectorIds !== null) {
            if (empty($vectorIds)) {
                return [
                    'results' => [],
                    'total' => 0,
                    'page' => 1,
                    'limit' => $limit,
                    'confidence' => 'none',
                    'related_results' => [],
                    'related_heading' => 'Related Products',
                ];
            }
            $productsQuery->whereIn('products.id', $vectorIds);
        } else {
            $rawQuery = $validated['query'] ?? '';
            $stopWords = [
                'i', 'me', 'my', 'we', 'our', 'you', 'your', 'he', 'she', 'it', 'they',
                'a', 'an', 'the', 'this', 'that', 'these', 'those',
                'is', 'am', 'are', 'was', 'were', 'be', 'been', 'being',
                'have', 'has', 'had', 'do', 'does', 'did',
                'will', 'would', 'shall', 'should', 'can', 'could', 'may', 'might',
                'want', 'need', 'looking', 'find', 'get', 'show',
                'for', 'of', 'in', 'on', 'at', 'to', 'with', 'from', 'by', 'about',
                'and', 'or', 'but', 'not', 'no', 'so', 'if', 'then',
                'some', 'any', 'all', 'very', 'just', 'also', 'please', 'thanks',
            ];

            $words = preg_split('/\s+/', strtolower(trim($rawQuery)));
            $keywords = array_values(array_filter($words, function ($w) use ($stopWords) {
                return strlen($w) >= 2 && !in_array($w, $stopWords, true);
            }));

            if (!empty($keywords)) {
                $productsQuery->leftJoin('product_types', 'products.product_type_id', '=', 'product_types.id')
                    ->leftJoin('brands', 'products.brand_id', '=', 'brands.id');

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
                $productsQuery->selectRaw("products.*, ({$relevanceExpr}) as relevance_score", $bindings);

                $productsQuery->where(function ($q) use ($keywords) {
                    foreach ($keywords as $kw) {
                        $like = "%{$kw}%";
                        $q->orWhere('products.name', 'like', $like)
                          ->orWhere('products.description', 'like', $like)
                          ->orWhere('product_types.name', 'like', $like)
                          ->orWhere('brands.name', 'like', $like);
                    }
                });
            } else {
                $productsQuery->where('products.name', 'like', "%{$rawQuery}%")
                    ->orWhere('products.description', 'like', "%{$rawQuery}%");
            }
        }

        if (!empty($filters['product_type'])) {
            $productsQuery->whereHas('productType', function($q) use ($filters) {
                $q->where('slug', $filters['product_type']);
            });
        }
        if (!empty($filters['space'])) {
            $productsQuery->whereHas('spaces', function($q) use ($filters) {
                $q->where('slug', $filters['space']);
            });
        }
        if (!empty($filters['brand'])) {
            $productsQuery->whereHas('brand', function($q) use ($filters) {
                $q->where('slug', $filters['brand']);
            });
        }
        if (!empty($filters['color'])) {
            $productsQuery->whereHas('colors', function($q) use ($filters) {
                $q->where('name', $filters['color']);
            });
        }
        if (!empty($filters['material'])) {
            $productsQuery->whereHas('materials', function($q) use ($filters) {
                $q->where('name', $filters['material']);
            });
        }
        if (isset($filters['min_price']) && is_numeric($filters['min_price'])) {
            $productsQuery->where('products.price', '>=', floatval($filters['min_price']));
        }
        if (isset($filters['max_price']) && is_numeric($filters['max_price'])) {
            $productsQuery->where('products.price', '<=', floatval($filters['max_price']));
        }
        if (!empty($filters['availability'])) {
            $productsQuery->where('products.availability', $filters['availability']);
        }

        if ($sort === 'latest') {
            $productsQuery->orderByDesc('products.created_at');
        } elseif ($sort === 'name_asc') {
            $productsQuery->orderBy('products.name', 'asc');
        } elseif ($sort === 'name_desc') {
            $productsQuery->orderBy('products.name', 'desc');
        } elseif ($sort === 'price_asc') {
            $productsQuery->orderBy('products.price', 'asc');
        } elseif ($sort === 'price_desc') {
            $productsQuery->orderBy('products.price', 'desc');
        } elseif ($sort === 'popular') {
            $productsQuery->orderByDesc('products.is_featured');
        } else {
            if ($vectorIds !== null && !empty($vectorIds)) {
                $idsString = implode(',', array_map('intval', $vectorIds));
                $productsQuery->orderByRaw("FIELD(products.id, {$idsString})");
            } else {
                if (isset($keywords) && !empty($keywords)) {
                    $productsQuery->orderByDesc('relevance_score');
                } else {
                    $productsQuery->orderByDesc('products.is_featured')->latest();
                }
            }
        }

        $paginated = $productsQuery->paginate($limit);

        $relatedProducts = collect();
        $resultIds = $paginated->pluck('id')->all();
        if ($paginated->isNotEmpty()) {
            $typeIds = $paginated->pluck('product_type_id')->filter()->unique()->all();
            $brandIds = $paginated->pluck('brand_id')->filter()->unique()->all();

            $relatedProducts = Product::query()
                ->with(['productType', 'brand'])
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

        if ($relatedProducts->isEmpty()) {
            $relatedProducts = Product::query()
                ->with(['productType', 'brand'])
                ->whereNotIn('id', $resultIds)
                ->where('is_featured', true)
                ->inRandomOrder()
                ->take(8)
                ->get();
        }

        // ── Related Blogs ─────────────────────────────────────
        $relatedBlogs = collect();
        $rawQuery = $validated['query'] ?? '';
        if (!empty($rawQuery)) {
            if ($this->aiSearch->isEnabled()) {
                try {
                    $payload = [
                        'query' => $rawQuery,
                        'page' => 1,
                        'limit' => 6,
                    ];
                    $data = $this->aiSearch->searchBlogs($payload);
                    $blogIds = collect($data['results'] ?? [])->pluck('id')->all();
                    
                    if (!empty($blogIds)) {
                        $idsString = implode(',', array_map('intval', $blogIds));
                        $relatedBlogs = Blog::with('categories')
                            ->whereIn('id', $blogIds)
                            ->orderByRaw("FIELD(id, {$idsString})")
                            ->get();
                    }
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::warning('AI blog search failed, falling back to SQL', ['error' => $e->getMessage()]);
                }
            }

            // Fallback: if AI search is disabled, failed, or returned no results
            if ($relatedBlogs->isEmpty()) {
                $blogStopWords = [
                    'i', 'me', 'my', 'we', 'our', 'you', 'your', 'he', 'she', 'it', 'they',
                    'a', 'an', 'the', 'this', 'that', 'these', 'those',
                    'is', 'am', 'are', 'was', 'were', 'be', 'been', 'being',
                    'have', 'has', 'had', 'do', 'does', 'did',
                    'will', 'would', 'shall', 'should', 'can', 'could', 'may', 'might',
                    'want', 'need', 'looking', 'find', 'get', 'show',
                    'for', 'of', 'in', 'on', 'at', 'to', 'with', 'from', 'by', 'about',
                    'and', 'or', 'but', 'not', 'no', 'so', 'if', 'then',
                    'some', 'any', 'all', 'very', 'just', 'also', 'please', 'thanks',
                ];
                $blogWords = preg_split('/\s+/', strtolower(trim($rawQuery)));
                $blogKeywords = array_values(array_filter($blogWords, function ($w) use ($blogStopWords) {
                    return strlen($w) >= 2 && !in_array($w, $blogStopWords, true);
                }));

                if (!empty($blogKeywords)) {
                    $relatedBlogs = Blog::with('categories')
                        ->where(function ($q) use ($blogKeywords) {
                            foreach ($blogKeywords as $kw) {
                                $like = "%{$kw}%";
                                $q->orWhere('title', 'like', $like)
                                  ->orWhere('content', 'like', $like)
                                  ->orWhere('meta_keywords', 'like', $like);
                            }
                        })
                        ->latest()
                        ->take(6)
                        ->get();
                }
            }
        }

        // Fallback: if no blogs matched, show latest blogs
        if ($relatedBlogs->isEmpty()) {
            $relatedBlogs = Blog::with('categories')
                ->latest()
                ->take(6)
                ->get();
        }

        return [
            'results' => $paginated->map(fn (Product $p) => [
                'id' => (string) $p->id,
                'title' => $p->name,
                'slug' => $p->slug,
                'url' => route('product.detail', $p->slug),
                'image_url' => $p->referenceImageUrl(),
                'price' => $p->price,
                'brand_name' => $p->brand?->name ?? '',
                'category' => $p->productType?->name ?? '',
                'similarity_score' => 0.5,
            ])->values()->all(),
            'total' => $paginated->total(),
            'page' => $paginated->currentPage(),
            'limit' => $paginated->perPage(),
            'confidence' => $vectorIds !== null ? 'high' : 'medium',
            'message' => $vectorIds !== null ? 'Showing AI search results.' : 'Showing keyword results (AI search offline).',
            'related_results' => $relatedProducts->map(fn (Product $p) => [
                'id' => (string) $p->id,
                'title' => $p->name,
                'slug' => $p->slug,
                'url' => route('product.detail', $p->slug),
                'image_url' => $p->referenceImageUrl(),
                'price' => $p->price,
                'brand_name' => $p->brand?->name ?? '',
                'category' => $p->productType?->name ?? '',
                'similarity_score' => 0.4,
            ])->values()->all(),
            'related_heading' => 'Related Products',
            'related_blogs' => $relatedBlogs->map(fn (Blog $b) => [
                'id' => (string) $b->id,
                'title' => $b->title,
                'slug' => $b->slug,
                'url' => route('resource.detail', $b->slug),
                'image_url' => $b->featuredImageUrl(),
                'excerpt' => \Illuminate\Support\Str::limit(strip_tags($b->content), 120),
                'categories' => $b->categories->pluck('name')->all(),
                'created_at' => $b->created_at?->format('M d, Y') ?? '',
            ])->values()->all(),
        ];
    }

    protected function enrichProductList(array $items): array
    {
        $ids = collect($items)->pluck('id')->filter()->all();
        $products = Product::query()
            ->with(['productType', 'brand'])
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
                $item['brand_name'] = $product->brand?->name ?? '';
                $item['category'] = $product->productType?->name ?? ($item['category'] ?? '');
            }

            return $item;
        })->values()->all();
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


}
