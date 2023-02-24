<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderInfoResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'final_price' => $this->final_price,
            'status' => $this->status(),
            'cart' => new CartResource($this->cart()),
            'city' => $this->city()->name,
            'province' => $this->province()->name,
            'user' => new UserResource($this->user()),
            'address' => $this->address,
            'zip_code' => $this->zip_code,
            'shipping_cost' => $this->shipping_cost,
            'telephone' => $this->telephone,
            'ordered_at' => $this->ordered_at,
            'sent_at' => $this->sent_at,
            'received_at' => $this->received_at,
        ];
    }
}
