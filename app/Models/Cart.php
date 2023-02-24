<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    public function has($product_id) {
        
        return Item::all()
        ->where('cart_id', $this->id)
        ->where('product_id', $product_id)
        ->count();
    }

    public function user() {
        return User::find($this->user_id);
    }

    public function item($product_id) {

        return Item::all()
        ->where('cart_id', $this->id)
        ->where('product_id', $product_id)
        ->first();
    }

    public function items() {

        return Item::all()
        ->where('cart_id', $this->id);
    }

    public function countProducts() {

        return Item::all()
        ->where('cart_id', $this->id)
        ->count();
        
    }

    public function totalPrice() {

        $result = 0;

        foreach ($this->items() as $i) {
            $result += $i->product()->price * $i->count;
        }

        return $result;
    }

    public function order() {

        return Order::all()
        ->where('cart_id', $this->id)
        ->first();
    }
}
