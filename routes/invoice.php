<?php

use App\V1\Invoice\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('customer')->group(function () {
        Route::get('invoice', [InvoiceController::class, 'store']);
        Route::get('invoice', [InvoiceController::class, 'show']);
        Route::delete('invoice', [InvoiceController::class, 'delete']);
    });
});
