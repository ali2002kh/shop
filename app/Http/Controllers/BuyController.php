<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\User;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BuyController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function add_to_cart(Request $request, $product_id) {

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
        
        if ($request->session()->get('prev') == 'cart') {
            return redirect()->route('cart');
        }
        return redirect()->route('product.show', $product_id);
    }

    public function remove_from_cart(Request $request, $product_id) {

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

        // dd($request->session());

        if ($request->session()->get('prev') == 'cart') {
            return redirect()->route('cart');
        }
        return redirect()->route('product.show', $product_id);
    }

    public function cart(Request $request) {

        $request->session()->put('prev', 'cart');

        $categories = Category::all();

        return view('client.pages.product.cart', compact('categories'));
    }

    public function checkout(Request $request) {

        $provinces = DB::table('provinces')->get();

        return view('client.pages.product.checkout', compact('provinces'));
    }

    public function getCities(Request $request) {

        $cities = DB::table('cities')
            ->where('province_id', $request->province_id)
            ->get();

        if (count($cities) > 0) {
            return response()->json($cities);
        }
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

        return redirect()->route('success', $order->code);
    }

    public function success ($order_code) {

        $order = Order::all()->where('code', $order_code)->first();

        return view('client.pages.product.success', compact('order'));
    }

    public function order ($order_code) {

        $order = Order::all()->where('code', $order_code)->first();

        $categories = Category::all();

        return view('client.pages.product.order', compact('order', 'categories'));
    }
}
