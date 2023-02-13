<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;

class HomeController extends Controller
{
    public function index() {

        $recommended = Product::where('recommended', true)
        ->orderBy('created_at', 'DESC')->take(5)->get();

        $popular = Product::all()->sortByDesc('sold')->take(6);
        
        $newest = Product::all()->sortByDesc('created_at')->take(6);

        $categories = Category::all();

        return view('client.pages.home', compact('recommended', 'popular', 'newest', 'categories'));
    }

    public function about_us()
    {

        $categories = Category::all();

        return view('client.pages.about_us', compact('categories'));
    }

    public function search(Request $request) {

        $input = $request->input;

        $products = [];

        if($input != '') {
            $products = Product::where('name','LIKE',"%".$input."%")->get();
        }

        return ProductResource::collection($products);
        
        // return response()->json([
        //     'products' => $products,
        // ]);
    }
}
