<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();

        $categories->each(function ($category, $products) {
            Product::factory()->count(2)->create([
                'category_id' => $category->id,
            ]);
        });
    }
}
