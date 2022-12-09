<?php

use App\V1\Customer\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('customers')->group(function () {
        Route::get('', [CustomerController::class, 'index']);
        Route::post('', [CustomerController::class, 'store']);
        Route::get('{customer}', [CustomerController::class, 'show']);
        Route::put('{customer}', [CustomerController::class, 'update']);
        Route::delete('{customer}', [CustomerController::class, 'delete']);
    });
});
