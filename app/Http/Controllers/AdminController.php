<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller {

    public function __construct() {
        $this->middleware(['auth','admin']);
    }

    public function dashboard() {

        return view('admin.pages.dashboard');
    }

    public function products() {

        $products = Product::all();
        
        return view('admin.pages.product.index', compact('products'));
    }

    public function deleteProduct ($product_id) {

        $product = Product::find($product_id);
        $product->delete();

        return redirect()->back();
    }

    public function createProduct() {

        return view('admin.pages.product.create');
    }
}
