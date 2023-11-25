<?php

namespace App\Repositories;

use App\Models\{
    Product,
    User,
    UserAddress,
    Order,
    OrderDetail
};

class OrderRepository
{
    public function storeOrder(User $user, UserAddress $userAddress, array $products): Order
    {
        $order = new Order();
        $order->user_id = $user->id;
        $order->user_address_id = $userAddress->id;
        $order->save();
        
        foreach ($products as $orderProduct) {
            $product = Product::find($orderProduct['id']);
            
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $orderProduct['quantity'],
                'unit_price' => $product->price,
                'total_price' => $product->price * $orderProduct['quantity'],
            ]);
        }

        return $order;
    }
}