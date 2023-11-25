<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function updateStock(int $id, int $quantity): void
    {
        $product = Product::find($id);
        $product->stock -= $quantity;
        $product->save();
    }
}