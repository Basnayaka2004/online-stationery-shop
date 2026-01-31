<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'payment_method' => $this->payment_method,
            'payment_amount' => $this->payment_amount,
            'payment_date'   => $this->payment_date,

            'customer' => new CustomerResource($this->whenLoaded('customer')),
            'order'    => new OrderResource($this->whenLoaded('order')),
        ];
    }
}
