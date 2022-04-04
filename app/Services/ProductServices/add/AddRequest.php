<?php

namespace App\Services\ProductServices\add;

class AddRequest
{
    private string $sku;
    private string $name;
    private int $quantity;
    private float $price;

    public function __construct(string $sku, string $name, int $quantity, float $price)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
    }
    public function getSku(): string
    {
        return $this->sku;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getQuantity(): int
    {
        return $this->quantity;
    }
    public function getPrice(): float
    {
        return $this->price;
    }
}