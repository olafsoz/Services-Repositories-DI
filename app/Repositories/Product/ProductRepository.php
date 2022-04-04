<?php

namespace App\Repositories\Product;
use App\Models\Product;

interface ProductRepository
{
    public function show(): array;
    public function add(Product $product): void;
//    public function getLastId(): array;
    public function showOne(int $id): array;
}