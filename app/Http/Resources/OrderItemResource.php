<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'quantity'          => $this->quantity,
            'price_at_purchase' => $this->price_at_purchase,

            'cart_item' => new CartItemResource($this->whenLoaded('cartItem')),
        ];
    }
}
