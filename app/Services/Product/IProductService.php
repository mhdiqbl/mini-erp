<?php

namespace App\Services\Product;

interface IProductService
{
    public function createProduct($dataProduct);
    public function filter($dataProduct);
}
