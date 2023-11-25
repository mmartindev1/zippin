<?php

namespace App\Services;

use App\Repositories\{
    OrderRepository,
    ProductRepository
};

use App\Models\{
    User,
    Order,
    UserAddress
};

class OrderService
{
    protected $orderRepository;
    protected $productRepository;

    public function __construct(OrderRepository $orderRepository, ProductRepository $productRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
    }

    public function newOrder(User $user, UserAddress $userAddress, array $products): Order
    {
        $order = $this->orderRepository->storeOrder($user, $userAddress, $products);

        foreach ($products as $product) {
            $this->productRepository->updateStock($product['id'], $product['quantity']);
        }

        return $order;
    }
}