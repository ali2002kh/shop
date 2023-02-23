<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function show ($id) {

        return new ProductResource(Product::find($id));
    }

    public function category ($category_name, $page) {
        
        $category = Category::where('name', $category_name)->first();

        $page_size = 9;

        if ($page == 0) {
            return ['count' => $category->products()->count(), 'page_size' => $page_size];
        }

        $products = $category->products()->skip(($page-1) * $page_size)->take($page_size)->get();

        return ProductResource::collection($products);
    }

    public function index() {

        return ProductResource::collection(Product::all());
    }
}
