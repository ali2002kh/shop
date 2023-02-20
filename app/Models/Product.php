<?php

namespace App\Models;

use Attribute;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\TryCatch;

use function PHPUnit\Framework\returnSelf;

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

        $user = auth()->user();

        if ($user == null) {
            return 0;
        }

        if (!$user->hasCart()) {
            return 0;
        }

        $cart = $user->cart();

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

    public function alone_in_cart() {

        $user = auth()->user();

        if ($user == null || !$user->hasCart()) {
            return true;
        }

        $cart = $user->cart();

        $item =  Item::all()
        ->where('product_id', $this->id)
        ->where('cart_id', $cart->id)
        ->first();

        try {
            foreach ($cart->items() as $i) {
                if ($i->id != $item->id) {
                    return false;
                }
            }
            return true;

        } catch (Exception $e) {
            return null;
        }
            
    }
}
