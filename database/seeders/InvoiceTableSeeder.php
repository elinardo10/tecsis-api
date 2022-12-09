<?php

namespace Database\Seeders;

use App\Models\User;
use App\V1\Product\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class InvoiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function ($customer) {
            $customer->products()->each(function ($product) use ($customer){
                $customer->invoices()->create([
                    'due_date' => now(),
                     'total' => $product->amount
                ]);
            });
        });
    }
}
