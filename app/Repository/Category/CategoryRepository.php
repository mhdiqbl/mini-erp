<?php
namespace App\Repository\Category;


use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoryRepository implements ICategoryRepository
{

    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function findCategory()
    {
        return Cache::remember('categories', 1440, function () {
            return $this->category->take(10)->get();
        });
    }

    public function addCategory($dataCategory)
    {
        $category = $this->category->create([
            'name' => $dataCategory->name,
            'slug' => strtolower(Str::slug($dataCategory->name)),
        ]);
        return $category;
    }
}
?>
