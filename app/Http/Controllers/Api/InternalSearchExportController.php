<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductSearchExporter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InternalSearchExportController extends Controller
{
    public function __invoke(Request $request, ProductSearchExporter $exporter): JsonResponse
    {
        $key = $request->header('X-Export-Key') ?? $request->query('key');
        if ($key !== config('ai-search.export_key')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json(['products' => $exporter->exportPayloads()]);
    }
}
