<?php

namespace App\Models;

class Product
{
    private string $sku;
    private string $name;
    private int $quantity;
    private float $price;
    private int $id;

    public function __construct(string $sku, string $name, int $quantity, float $price, ?int $id = null)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
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