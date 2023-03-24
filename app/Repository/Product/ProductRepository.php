<?php

namespace App\Repository\Product;
use App\Helpers\ResponseFormatter;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProductRepository implements IProductRepository
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function addProduct($dataProduct)
    {
        $product = $this->product->create([
            'sku' => $dataProduct->sku,
            'name' => $dataProduct->name,
            'slug' => strtolower(Str::slug($dataProduct->name)),
            'price' => $dataProduct->price,
            'stock' => $dataProduct->stock,
            'category_id' => $dataProduct->categoryId,
        ]);
        return $product;
    }

    public function filterProduct($dataProduct)
    {
        $skus = $dataProduct->input('sku', []);
        $names = $dataProduct->input('name', []);
        $priceStart = $dataProduct->input('price-start', null);
        $priceEnd = $dataProduct->input('price-end', null);
        $stockStart = $dataProduct->input('stock-start', null);
        $stockEnd = $dataProduct->input('stock-end', null);
        $categoryIds = $dataProduct->input('category-id', []);
        $categoryNames = $dataProduct->input('category-name', []);

        $query =$this->product
            ->with('category:id,name')
            ->newQuery();

        if (!empty($skus)) {
            $query->whereIn('sku', $skus);
        }

        if (!empty($names)) {
            foreach ($names as $name) {
                $query->where('name', 'like', '%'.$name.'%');
            }
        }

        if (!is_null($priceStart)) {
            $query->where('price', '>=', $priceStart);
        }

        if (!is_null($priceEnd)) {
            $query->where('price', '<=', $priceEnd);
        }

        if (!is_null($stockStart)) {
            $query->where('stock', '>=', $stockStart);
        }

        if (!is_null($stockEnd)) {
            $query->where('stock', '<=', $stockEnd);
        }

        if (!empty($categoryIds)) {
            $query->whereIn('category_id', $categoryIds);
        }

        if (!empty($categoryNames)) {
            $query->whereHas('category', function ($query) use ($categoryNames) {
                    $query->whereIn('slug',$categoryNames);
                });
        }

        $product = $query->paginate(7);

            return (object) [
                'data' => ProductResource::collection($product),
                "paging" => [
                    'size' => $product->perPage(),
                    'total' => $product->lastPage(),
                    'current_page' => $product->currentPage(),
                ],
            ];
    }
}
