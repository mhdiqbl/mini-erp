<?php

namespace App\Repository\Category;

interface ICategoryRepository
{
    public function findCategory();
    public function addCategory($dataCategory);
}
