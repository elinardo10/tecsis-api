<?php

namespace Database\Seeders;

use App\Models\User;
use App\V1\Product\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function ($customer) {
            $customer->products()->createMany(Product::factory(10)->make()->toArray());
        });
    }
}
