<?php

namespace App\Services\ProductServices\add;

use App\Models\Product;
use App\Repositories\Product\ProductRepository;

class AddService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(AddRequest $request): Product
    {
//        $id = $this->productRepository->getLastId();
        $product = new Product(
            $request->getSku(),
            $request->getName(),
            $request->getQuantity(),
            $request->getPrice(),
//            $id["MAX(id)"]++,
        );
        $this->productRepository->add($product);
        return $product;
    }
}