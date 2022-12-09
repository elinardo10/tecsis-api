<?php

use App\V1\Product\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('vps')->group(function () {
        Route::post('product', [ProductController::class, 'store']);
        Route::get('product', [ProductController::class, 'show']);
        Route::put('product', [ProductController::class, 'update']);
        Route::delete('product', [ProductController::class, 'delete']);
    });
});
