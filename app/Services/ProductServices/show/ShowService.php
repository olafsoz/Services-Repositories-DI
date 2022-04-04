<?php

namespace App\Services\ProductServices\show;


use App\Repositories\Product\ProductRepository;

class ShowService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function execute(): array
    {
        return $this->productRepository->show();
    }
}