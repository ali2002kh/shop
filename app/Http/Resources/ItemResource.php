<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $count_one = false;
        if ($this->count == 1) {
            $count_one = true;
        }

        return [
            'product_id' => $this->product_id,
            'product_name' => $this->product()->name,
            'product_price' => $this->product()->price,
            'count' => $this->count,
            'count_one' => $count_one,
            'old_price' => $this->old_price,
        ];
    }
}
