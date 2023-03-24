<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'BAHAN POKOK & BAHAN MASAKAN',
            'MAKANAN',
            'MINUMAN',
            'PERAWATAN DIRI',
            'IBU & ANAK',
            'FASHION',
            'KEBUTUHAN RUMAH',
            'ALAT TULIS & PERLENGKAPAN KANTOR',
            'PRODUK SEGAR',
            'PPOB, PULSA, EMONEY',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => strtolower(Str::slug($category)),
//                'type_dept_category_id' => rand(1,11),
//                'thumbnail' => rand(111,999).'.jpg',
            ]);
        }
    }
}
