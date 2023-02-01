<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($product_id) {
        
        $product = Product::find($product_id);

        $categories = Category::all();

        $popular = Product::all()->sortByDesc('sold')->take(6);

        return view('client.pages.product.show', compact('product', 'categories', 'popular'));
    }
}
