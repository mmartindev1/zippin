<?php

namespace App\Http\Controllers;

use Illuminate\Http\{
    Request,
    Response,
    JsonResponse
};
use App\Models\{
    Product, 
    Order, 
    OrderDetail,
    UserAddress
};
use App\Http\Requests\StoreOrderRequest;
use App\Services\OrderService;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OrderResource::collection(
            Order::latest()
                ->paginate()
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request, OrderService $orderService): JsonResponse
    {
        $user = $request->user();
        $address = UserAddress::find($request->address);
        $products = $request->products;

        $order = $orderService->newOrder($user, $address, $products);

        return response()->json(
            new OrderResource($order)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order): JsonResponse
    {
        return response()->json(
            new OrderResource($order)
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
