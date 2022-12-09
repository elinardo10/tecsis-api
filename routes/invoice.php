<?php

use App\V1\Invoice\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('invoices')->group(function () {
        Route::get('', [InvoiceController::class, 'index']);
        Route::post('', [InvoiceController::class, 'store']);
        Route::get('{invoice}', [InvoiceController::class, 'show']);
        Route::delete('{invoice}', [InvoiceController::class, 'delete']);
    });
});
