<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

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
}
