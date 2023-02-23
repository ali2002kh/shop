<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $result = [
            'id' => $this->id,
            'number' => $this->number,
            'email' => $this->email,
            'fname' => $this->fname,
            'lname' => $this->lname,
            'orders' => OrderResource::collection($this->orders()),
            'has_cart' => $this->hasCart(),
            'is_admin' => $this->is_admin,
        ];

        if ($this->hasCart()) {
            $result['countProductsInCart'] = $this->cart()->countProducts();
        }

        return $result;
    }
}
