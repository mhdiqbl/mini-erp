<?php

namespace App\Repository\Product;

interface IProductRepository
{
    public function addProduct($dataProduct);
    public function filterProduct($dataProduct);
}
