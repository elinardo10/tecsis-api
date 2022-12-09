<?php

use App\V1\Product\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('products')->group(function () {
        Route::get('', [ProductController::class, 'index']);
        Route::post('', [ProductController::class, 'store']);
        Route::get('{product}', [ProductController::class, 'show']);
        Route::put('{product}', [ProductController::class, 'update']);
        Route::delete('{product}', [ProductController::class, 'delete']);
    });
});
