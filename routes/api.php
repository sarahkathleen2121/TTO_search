<?php

use App\Http\Controllers\Api\InternalSearchExportController;
use App\Http\Controllers\Api\SearchController;
use Illuminate\Support\Facades\Route;

Route::prefix('search')->middleware('throttle:search')->group(function () {
    Route::get('/suggestions', [SearchController::class, 'suggestions']);
    Route::post('/text', [SearchController::class, 'text']);
    Route::post('/image', [SearchController::class, 'image']);
    Route::post('/scene', [SearchController::class, 'scene']);
    Route::get('/filters', [SearchController::class, 'filters']);
    Route::get('/health', [SearchController::class, 'health']);
});

Route::get('/internal/search/export', InternalSearchExportController::class)
    ->middleware('throttle:60,1');
