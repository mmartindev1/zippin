<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'address' => new UserAddressResource($this->userAddress),
            'date' => $this->created_at,
            'order_detail' => OrderDetailResource::collection($this->orderDetails),
            'total_price' => $this->totalPrice(),
        ];
    }
}
