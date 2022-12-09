<?php

namespace Database\Factories;

use App\V1\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{

/**
 * The name of the factory's corresponding model.
 *
 * @var string
 */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'        => $this->faker->sentence(1),
            'description' => $this->faker->text,
            'qty'         => $this->faker->randomDigit,
            'amount'      => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
