<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
    $name = $this->faker->name();
            return [
                'name' => $name,
                'slug' => strtolower(Str::slug($name)),
                'sku' => $this->faker->numberBetween(10000, 50000),
                'price' => $this->faker->numberBetween(10000, 50000),
                'stock' => $this->faker->numberBetween(10000, 50000),
                'category_id' => null,
            ];
    }
}
