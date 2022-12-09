<?php

namespace App\V1\Invoice\Services;

use App\Models\User;
use App\V1\Product\Models\Product;

class InvoiceService
{
    public function create(array $input)
    {
        $customer = User::query()->findOrFail($input['customer_id']);
        $product = Product::query()->findOrFail($input['product_id']);

        return $customer->invoices()->create([
            'customer_id' => $input['customer_id'],
            'total'       => $product->amount,
            'due_date'    => now(),
        ]);
    }
}
