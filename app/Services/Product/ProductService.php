<?php

namespace App\Services\Product;

use App\Helpers\ResponseFormatter;
use App\Http\Resources\ProductResource;
use App\Repository\Product\IProductRepository;
use http\Env\Request;
use Illuminate\Support\Facades\Log;

class ProductService implements IProductService
{

    private $product;

    public function __construct(IProductRepository $product)
    {
        $this->product = $product;
    }

    public function createProduct($dataProduct)
    {
        try {
            $product = $this->product->addProduct($dataProduct);
            return ResponseFormatter::success(new ProductResource($product), 'Data product berhasil ditambahkan', 201);
        } catch (\Exception $err) {
            Log::error($err->getMessage());
        }
    }

    public function filter($dataProduct)
    {
        return $this->product->filterProduct($dataProduct);
    }
}
