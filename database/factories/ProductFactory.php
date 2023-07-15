<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [

            'product_code' => $this->faker->randomElement(['A00', 'B00', 'C00']),
            'product_name' => $this->faker->name,
            'price' => $this->faker->unique()->numberBetween(100, 900),

        ];
    }
}
