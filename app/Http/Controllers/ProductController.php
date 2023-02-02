<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show (Request $request, $product_id) {

        $request->session()->put('prev', 'product');
        
        $product = Product::find($product_id);

        $categories = Category::all();

        $popular = Product::all()->sortByDesc('sold')->take(6);

        return view('client.pages.product.show', compact('product', 'categories', 'popular'));
    }

    public function category (Request $request, $category_id) {
        
        $category = Category::find($category_id);

        $categories = Category::all();

        return view('client.pages.product.category', compact('category', 'categories'));
    }

    public function index (Request $request) {

        $categories = Category::all();

        if ($request->session()->get('category') == null || $request->session()->get('category') == 'all') {
            $products = Product::where('id', '>', 0);
        } else {
            $products = Product::where('category_id', $request->session()->get('category'));
        }
        if ($request->session()->get('sort') == null) {
            $products = $products->orderBy('created_at', 'DESC');
        } else if ($request->session()->get('sort') == 'cheap') {
            $products = $products->orderBy('price', 'ASC');
        } else {
            $products = $products->orderBy($request->session()->get('sort'), 'DESC');
        }

        $products = $products->paginate(8);

        return view('client.pages.product.index', compact('categories', 'products'));
    }

    public function filter (Request $request) {

        $request->session()->put('sort', $request->get('sort'));
        $request->session()->put('category', $request->get('category'));

        return redirect()->back();
    }
}
