<?php

namespace App\Repositories\Product;
use App\Database;
use App\Models\Product;
use Doctrine\DBAL\Exception;

class MySQLProductRepository implements ProductRepository
{
    public function show(): array
    {
        $everything = [];
        try {
            $products = Database::connection()
                ->createQueryBuilder()
                ->select('*')
                ->from('products')
                ->executeQuery()
                ->fetchAllAssociative();

            for($i = 0; $i < count($products); $i++) {
                $everything[] = new Product(
                    $products[$i]['sku'],
                    $products[$i]['name'],
                    $products[$i]['quantity'],
                    $products[$i]['price'],
                    $products[$i]['id']);
            }
        } catch (Exception $e) {
        }
        return $everything;
    }
    public function add(Product $product): void
    {
        try {
            Database::connection()
                ->insert('products', [
                    'sku' => $product->getSku(),
                    'name' => $product->getName(),
                    'quantity' => $product->getQuantity(),
                    'price' => $product->getPrice()
                ]);
        } catch (Exception $e) {
        }
    }
//    public function getLastId(): array
//    {
//        return Database::connection()
//            ->createQueryBuilder()
//            ->select('MAX(id)')
//            ->from('products')
//            ->executeQuery()
//            ->fetchAssociative();
//    }
    public function showOne(int $id): array
    {
        return Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('products')
            ->where('id = ?')
            ->setParameter(0, $id)
            ->executeQuery()
            ->fetchAssociative();
    }
}