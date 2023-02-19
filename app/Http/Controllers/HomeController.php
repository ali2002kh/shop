<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function recommended () {

        $recommended = Product::where('recommended', true)
        ->orderBy('created_at', 'DESC')->take(5)->get();

        return (ProductResource::collection($recommended));
    }

    public function popular () {

        $popular = Product::all()->sortByDesc('sold')->take(6);

        return (ProductResource::collection($popular));
    }

    public function newest () {

        $newest = Product::all()->sortByDesc('created_at')->take(6);

        return (ProductResource::collection($newest));
    }

    public function categories () {

        $categories = Category::all();

        return (CategoryResource::collection($categories));
    }

    public function user () {
        
        if (Auth::check()) {
            return new UserResource(auth()->user());
        } else {
            return abort(401);
        }
        
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
