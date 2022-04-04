<?php

namespace App\Services\ProductServices\showOne;

use App\Repositories\Product\ProductRepository;

class ShowOneService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(ShowOneRequest $request): array
    {
        return $this->productRepository->showOne($request->getId());
    }
}