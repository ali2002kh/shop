<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image(),
            'price' => $this->price,
            'count' => $this->count,
            'category' => $this->category()->name,
            'description' => $this->description,
            'details' => $this->details,
            'count_in_cart' => $this->count_in_cart(),
            'alone_in_cart' => $this->alone_in_cart(),
            'image' => '/storage/product/'.$this->image(),
            'images' => ImageResource::collection($this->images()),
            'recommended' => $this->recommended,
            'sold' => $this->sold,
        ];
    }
}
