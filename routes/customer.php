<?php

use App\V1\Customer\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('customer')->group(function () {
        Route::post('customer', [CustomerController::class, 'index']);
        Route::get('customer', [CustomerController::class, 'store']);
        Route::get('customer', [CustomerController::class, 'show']);
        Route::put('customer', [CustomerController::class, 'update']);
        Route::delete('customer', [CustomerController::class, 'delete']);
    });
});
