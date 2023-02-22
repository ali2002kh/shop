<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BuyController extends Controller {

    public function add_to_cart($product_id) {

        if (!auth()->check()) {
            return abort(401);
        }

        $user = auth()->user();

        if($user->hasCart()) {
            $cart = $user->cart();
            if($cart->has($product_id)) {
                $item = $cart->item($product_id);
                $item->count = $item->count + 1;
                $item->save();
            } else {
                $item = new Item([
                    'product_id' => $product_id,
                    'cart_id' => $cart->id,
                ]);
                $item->save();
            }
        } else {
            $cart = new Cart([
                'user_id' => $user->id,
            ]);
            $cart->save();

            $item = new Item([
                'product_id' => $product_id,
                'cart_id' => $cart->id,
            ]);
            $item->save();
        }

        $product = Product::find($product_id);
        
        return $product->count_in_cart();
    }

    public function remove_from_cart($product_id) {

        if (!auth()->check()) {
            return abort(401);
        }

        $cart = auth()->user()->cart();

        $item = $cart->item($product_id);
        if ($item->count <= 1) {
            $item->delete();
        } else {
            $item->count = $item->count - 1;
            $item->save();
        }

        if ($cart->countProducts() == 0) {
            $cart->delete();
        }

        $product = Product::find($product_id);
        
        return $product->count_in_cart();
    }

    public function cart() {

        return new CartResource(auth()->user()->cart());
    }

    public function provinces() {

        $provinces = DB::table('provinces')->get();

        if (count($provinces) > 0) {
            return response()->json($provinces);
        }
    }

    public function cities(Request $request) {

        $cities = DB::table('cities')
            ->where('province_id', $request->get('province'))
            ->get();

        return $cities;
 
    }

    public function buy(Request $request) {

        $request->validate([
            'zip_code' => 'required|max:10|min:10',
            'address' => 'required',
            'city' => 'required',
            'telephone' => 'required|regex:/0[0-9]{2,}[0-9]{7,}$/',
        ]);

        $user = auth()->user();

        $final_price = $user->cart()->totalPrice()*1.09 + 30000;

        // actual payment

        foreach ($user->cart()->items() as $item) {
            $item->old_price = $item->product()->price;
            $item->save();

            $product = $item->product();
            $product->sold += $item->count;
            $product->count -= $item->count;
            $product->save();
        }

        $order = new Order([
            'cart_id' => $user->cart()->id,
            'city_id' => $request->get('city'),
            'zip_code' => $request->get('zip_code'),
            'address' => $request->get('address'),
            // 'shipping_cost' => 30000,
            'final_price' => $final_price,
            'code' => Str::random(10),
            'telephone' => $request->get('telephone'),
            'ordered_at' => now(),
        ]);

        $order->save();

        // new Payment

        $cart = $user->cart();
        $cart->status = 0;
        $cart->save();

        return $order->code;
    }

    public function order ($order_code) {

        $order = Order::all()->where('code', $order_code)->first();

        return new OrderResource($order);
    }
}
