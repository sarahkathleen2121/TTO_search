<?php

return [
    'base_url' => env('AI_SEARCH_BASE_URL', 'http://127.0.0.1:8001'),
    'api_key' => env('AI_SEARCH_API_KEY', 'change-me-internal-key'),
    'export_key' => env('AI_SEARCH_EXPORT_KEY', 'change-me-export-key'),
    'media_base_url' => env('MEDIA_BASE_URL', env('APP_URL', 'http://localhost')),
    'timeout_text' => (int) env('AI_SEARCH_TIMEOUT_TEXT', 45),
    'timeout_image' => (int) env('AI_SEARCH_TIMEOUT_IMAGE', 30),
    'timeout_index' => (int) env('AI_SEARCH_TIMEOUT_INDEX', 600),
    'enabled' => env('AI_SEARCH_ENABLED', true),
    'fallback_sql' => env('AI_SEARCH_FALLBACK_SQL', true),
    'cache_enabled' => env('AI_SEARCH_CACHE_ENABLED', true),
    'cache_ttl' => (int) env('AI_SEARCH_CACHE_TTL', 600),
];
