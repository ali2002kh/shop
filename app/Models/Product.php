<?php

namespace App\Models;

use Attribute;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\TryCatch;

class Product extends Model
{
    use HasFactory;

    public function image() {
        try {
            return Image::where('product_id', $this->id)->where('main', true)->first()->link;
        }
        catch(Exception $e) {
            return "default.jpg";
        }
    }

    public function images() {
        return Image::where('product_id', $this->id)->get();
    }

    public function category() {
        return category::find($this->category_id);
    }

    public function count_in_cart() {

        $cart = auth()->user()->cart();

        $item =  Item::all()
        ->where('product_id', $this->id)
        ->where('cart_id', $cart->id)
        ->first();

        try {
            return $item->count;
        }
        catch(Exception $e) {
            return 0;
        }
    }
}
