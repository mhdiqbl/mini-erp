<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\Product\IProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;

    public function __construct(IProductService $productService)
    {
        $this->productService = $productService;
    }

    public function store(ProductRequest $request)
    {
        return $this->productService->createProduct($request);
    }

    public function filter(Request $request)
    {
//        dd($request->header('API-KEY'));
        return $this->productService->filter($request);
    }
}
