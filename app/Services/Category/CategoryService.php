<?php
namespace App\Services\Category;

use App\Helpers\ResponseFormatter;
use App\Repository\Category\ICategoryRepository;
use Illuminate\Support\Facades\Log;

class CategoryService implements ICategoryService
{
    private $category;

    public function __construct(ICategoryRepository $category)
    {
        $this->category = $category;
    }
    public function createCategory($dataCategory)
    {
        try {
            $category = $this->category->addCategory($dataCategory);
            return ResponseFormatter::success([
                'id' => $category->id,
                'name' => $category->name,
                'createdAt' => $category->getCreatedAtMillis(),
            ], 'Data category berhasil ditambahkan', 201);
        }catch (\Exception $err) {
            Log::error($err->getMessage());
        }
    }
}
?>
