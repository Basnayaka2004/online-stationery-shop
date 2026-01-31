<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'email'    => $this->email,
            'phone'    => $this->phone,
            'username' => $this->username,
            'address'  => [
                'street' => $this->street,
                'city'   => $this->city,
                'state'  => $this->state,
                'zip'    => $this->zip,
            ],

            'cart'     => new CartResource($this->whenLoaded('cart')),
            'payments' => PaymentResource::collection($this->whenLoaded('payment')),
        ];
    }
}
